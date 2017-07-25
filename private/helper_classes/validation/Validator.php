<?php

// STEPS on validating things.
/*
  // NOTE: Only user POST requests when making changes.
  //       Don't ever use GET changing things. Only use it to read things from the server.
  // 1) Avoid CSRF by using csrf tokens as hidden field in your forms.
  //
  //
  // 2) Use only allowable GET and POST variables.
  //    Maybe put an array like: $allowed_gets = array();
  //
  //
  // 3) Validate inputs.
  //      - presence
  //      - type (string, number, etc.)
  //      - format
  //      - within set of values/length (ex. between 2 and 8 etc)
  //      - uniqueness (TODO:REMINDER: Get back on this later. Maybe modify the db for many-to-many...
  //                                   For ex, the address used by User "OneTimeUserForOneTimeAddress"
  //                                   that is used whenever checking out for the PayPal address...)
  //
  //
  // 4) Strip tags.
  // TODO: Sanitize against html, js, url, mysql, php, cmd.
  //
  //
  //
  // 5) Avoid XSS by escaping inputs using functions h() j() u() and maybe s() for sql for output.
  //
  //
  // 6) Make 2 versions of variables: "dirty" and "sanitized".
  //    Strip html and script tags. Escape single quotes. Strip php tags.
  // 7) Sessions on Cookies.
  // 8) Check if that username exists in the db.
  // 9) Hash the password.
  // 10) Store it in db.
 * 
 */

namespace App\Privado\HelperClasses\Validation;

require_once('/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/public/__model/my_validation_error_logger.php');
require_once('/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/functions_helper/functions_csrf_token.php');
require_once(PRIVATE_PATH . "/includes/swiftmailer/config.php");

use App\Publico\Model\MyValidationErrorLogger;
use Swift_Validate;


class Validator
{

    private $allowed_post_vars_array = null;
    private $required_post_vars_length_array = null;
    private $vars_to_be_regex_checked = null;
    private $formats = null;
    private $vars_to_be_unique_checked = null;
    private $user_detail_types = null;
    private $json_errors_array = null;
    private $can_proceed = false;
    private $exempted_white_space_field_array = null;
    private $request_type = "post";
    public $validate_email = false;

    function __construct()
    {
        MyValidationErrorLogger::initialize();
    }

    public function set_allowed_post_vars($allowed_post_vars_array)
    {
        $this->allowed_post_vars_array = $allowed_post_vars_array;

        $this->init_json_errors_array();
    }



    public function set_unique_vars($vars_to_be_unique_checked)
    {
        $this->vars_to_be_unique_checked = $vars_to_be_unique_checked;
    }




    public function set_exempted_white_space_field_array($exempted_white_space_field_array)
    {
        $this->exempted_white_space_field_array = $exempted_white_space_field_array;
    }

    public function set_required_post_vars_length_array($post_vars_lengt_array)
    {
        $this->required_post_vars_length_array = $post_vars_lengt_array;
    }


    /**
     * @param $vars array
     */
    public function set_vars_to_be_regex_checked($vars)
    {
        $this->vars_to_be_regex_checked = $vars;
    }


    private function init_json_errors_array()
    {
        // Set the default error indexes.
        $this->json_errors_array = array("is_result_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "");

        // Set the additional error indexes depending on the form.
        foreach ($this->allowed_post_vars_array as $allowed_post_var) {
            $this->json_errors_array["error_" . $allowed_post_var] = "";
        }
    }

    public function get_json_errors_array()
    {
        return $this->json_errors_array;
    }

    public function validate()
    {
        $this->validate_csrf_token();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_csrf: {$this->can_proceed}");


        if ($this->can_proceed) {
            $this->check_required_post_vars_existence();
            \MyDebugMessenger::add_debug_message("\$this->can_proceed after check_required_existence: {$this->can_proceed}");
        }


        if ($this->can_proceed) {
            $this->validate_white_space();
            \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_whitespace: {$this->can_proceed}");
        }




//        if ($this->can_proceed) {
//            $this->validate_length();
//            \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_length: {$this->can_proceed}");
//        }
        $this->validate_length();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after validate_length: {$this->can_proceed}");



        if ($this->user_detail_types != null) {
            $this->validate_user_detail_types();
        }


        if ($this->formats != null) {
            //
            $this->validate_formats();
        }


        if ($this->validate_email) {
            //
            $this->validate_email_format();
        }



        if ($this->vars_to_be_unique_checked != null) {
            //
            $this->validate_uniqueness();
        }



        $this->set_json_errors_array();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after set_json_errors_array: {$this->can_proceed}");


        $this->finalize_validation();
        \MyDebugMessenger::add_debug_message("\$this->can_proceed after finalize_validation: {$this->can_proceed}");


        //
        return $this->can_proceed;
    }



    //
    public function set_user_detail_types($user_detail_types)
    {
        $this->user_detail_types = $user_detail_types;
    }



    private function validate_user_detail_types() {
        //
        foreach ($this->user_detail_types as $key => $accepted_values) {

            if (!in_array($_POST[$key], $accepted_values)) {
                MyValidationErrorLogger::log("{$key}::: is not valid.");
                $this->can_proceed = false;
            }

        }
    }


    private function validate_email_format()
    {
        if (!Swift_Validate::email($_POST["email"])) {
            MyValidationErrorLogger::log("email::: is not valid.");
            $this->can_proceed = false;
        }
    }


    public function set_formats($formats)
    {
        //
        $this->formats = $formats;
    }


    private function validate_regex($index, $regex)
    {
        if ($index == "user_name") {
            if (has_format_matching($_POST[$index], $regex)) {
                MyValidationErrorLogger::log("{$index}::: contains invalid chars.");
                $this->can_proceed = false;
            }
        } else if ($index == "password") {
            if (!has_format_matching($_POST[$index], $regex)) {
                MyValidationErrorLogger::log("{$index}::: should have at least 1 special character.");
                $this->can_proceed = false;
            }
        }
    }


    private function validate_formats()
    {
        //
        foreach ($this->formats as $index => $format) {
            // Validate regex.
            $this->validate_regex($index, $format['regex']);

            //
            $this->validate_min_numeric_chars($index, $format['numeric']);

            //
            $this->validate_min_alpha_chars($index, $format['alpha']);

        }
    }

    //
    private function validate_uniqueness()
    {
        //
        foreach ($this->vars_to_be_unique_checked as $field => $details) {
            //
            $d = $details;
            if (!is_unique($_POST[$field], $d['table'], $d['column'])) {
                MyValidationErrorLogger::log("{$field}::: is already taken.");
                $this->can_proceed = false;
            }

        }
    }


    private function validate_min_alpha_chars($index, $min)
    {
        // For at least 1 numeric chars.
        if (!has_alphabet_chars($_POST[$index], $min)) {
            MyValidationErrorLogger::log("{$index}::: should have at least {$min} alphabet characters.");

            $this->can_proceed = false;
        }
    }


    private function validate_min_numeric_chars($index, $min)
    {
        // For at least 1 numeric chars.
        if (!has_numeric_chars($_POST[$index], $min)) {
            MyValidationErrorLogger::log("{$index}::: should have at least {$min} numeric characters.");

            $this->can_proceed = false;
        }
    }


    private function validate_length()
    {
        // 
        $validation_value = true;

        //
        foreach ($this->required_post_vars_length_array as $key => $value) {
            if ($this->request_type == "get" && has_length($_GET[$key], $value)) {
                continue;
            } else if (has_length($_POST[$key], $value)) {
                continue;
            } else {
                MyValidationErrorLogger::log("{$key}::: should be between {$value['min']} to {$value['max']} characters.");

                $validation_value = false;
            }
        }

        $this->can_proceed = $validation_value;
    }

    // Validate the the POST vars contains something
    // that isn't just a white space.
    private function validate_white_space()
    {
        // 
        $validation_value = true;

        //
        foreach ($this->required_post_vars_length_array as $key => $value) {
            // If the $key is in the exempted white space field, disregard and loop again.
            if (isset($this->exempted_white_space_field_array) &&
                in_array($key, $this->exempted_white_space_field_array)
            ) {
                continue;
            }


//            // Before proceeding to the next section down here,
//            // uki
//            $global_var_being_validated = null;
//            if (isset($_POST[$key])) {
//                $global_var_being_validated = $_POST[$key];
//            }
//            else if (isset($_GET[$key])) {
//                $global_var_being_validated = $_GET[$key];
//            }
//            else {
//                $validation_value = false;
//                break;
//            }


            // Validate presence.
            if ($this->request_type == "get" && has_presence($_GET[$key])) {
                continue;
            } else if (has_presence($_POST[$key])) {
                continue;
            } else {
                MyValidationErrorLogger::log("{$key}::: can not be blank");

                $validation_value = false;
            }
        }

        $this->can_proceed = $validation_value;
    }

    private function check_required_post_vars_existence()
    {
        // White listing POST vars.
        if (are_post_vars_valid($this->allowed_post_vars_array)) {
            $this->can_proceed = true;
        } else {
            $this->can_proceed = false;
            MyValidationErrorLogger::log("are_vars_clean::: no. Incomplete and tampered");
        }
    }

    private function finalize_validation()
    {
        /* Here's I'll know if there's an error overall or not. */
        if (MyValidationErrorLogger::is_empty()) {
            // Proceed to the next validation step.
            $this->can_proceed = true;

//            $this->json_errors_array['is_result_ok'] = true;
        } else {
            $this->can_proceed = false;
        }
    }

    private function set_json_errors_array()
    {
        /* Log the errors. */
        // Put to the JSON array the first error for each error type.
        // Here, basically, one $log_error_msg is like:
        //      csrf_token::: not valid
        // So the returned json_error_array will have:
        //      json.error_csrf_token => "* not valid"
        foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
//            MyDebugMessenger::add_debug_message($log_error_msg);
            // Find which field that error is based on "field::: is bad" log_error_msg.
            // $pos = position of :::
            $pos = strpos($log_error_msg, ":::");

            $error_field = "error_" . substr($log_error_msg, 0, $pos);

            // If the error_field in the $json_errors_array doesn't have value yet,
            // add the log_error_msg.
            if ($this->json_errors_array[$error_field] == "") {
                $this->json_errors_array[$error_field] = "* " . substr($log_error_msg, $pos + 4);
            }
        }
    }


    /**
     * @Purpose is to avoid the csrf validation if the request
     * type is "get".
     * @Note that by default, this object's request type is set to "post".
     * @param string $type : "get" / "post"
     */
    public function set_request_type($type)
    {
        $this->request_type = $type;
    }

    private function validate_csrf_token()
    {
        // If the request type is GET, no need for csrf validation
        // so just return and proceed to the other validations.
        if ($this->request_type == "get") {
            $this->can_proceed = true;
            return;
        }


        // Check csrf_token.
        if (is_csrf_token_legit()) {
            $this->can_proceed = true;
//            $this->json_errors_array["error_csrf_token"] = "good";
//            // TODO:REMINDER: Delete this on production.
//            $json_errors_array['POST_csrf_token'] = $_POST['csrf_token'];
//            $json_errors_array['SESSION_csrf_token'] = $_SESSION['csrf_token'];
        } else {
            MyValidationErrorLogger::log("csrf_token::: invalid.");
            $this->can_proceed = false;
//            $this->json_errors_array["error_csrf_token"] = "bad";
        }
    }

}

?>
