<?php

namespace App\Privado\HelperClasses\Validation;

require_once('/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/public/__model/my_validation_error_logger.php');
require_once('/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/functions_helper/functions_csrf_token.php');

use App\Publico\Model\MyValidationErrorLogger;

class Validator {

    private $allowed_post_vars_array = null;
    private $required_post_vars_length_array = null;
    private $json_errors_array = null;
    private $can_proceed = false;

    function __construct() {
        MyValidationErrorLogger::initialize();
    }

    public function set_allowed_post_vars($allowed_post_vars_array) {
        $this->allowed_post_vars_array = $allowed_post_vars_array;

        $this->init_json_errors_array();
    }

    public function set_required_post_vars_length_array($post_vars_lengt_array) {
        $this->required_post_vars_length_array = $post_vars_lengt_array;
    }

    private function init_json_errors_array() {
        // Set the default error indexes.
        $this->json_errors_array = array("is_result_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "");

        // Set the additional error indexes depending on the form.
        foreach ($this->allowed_post_vars_array as $allowed_post_var) {
            $this->json_errors_array["error_" . $allowed_post_var] = "";
        }
    }

    public function get_json_errors_array() {
        return $this->json_errors_array;
    }

    public function validate() {
        $this->validate_csrf_token();


        if ($this->can_proceed) {
            $this->check_required_post_vars_existence();
        }


        if ($this->can_proceed) {
            $this->validate_white_space();
        }


        if ($this->can_proceed) {
            $this->validate_length();
        }


        if ($this->can_proceed) {
            $this->set_json_errors_array();
        }

        if ($this->can_proceed) {
            $this->finalize_validation();
        }


        //
        return $this->can_proceed;
    }

    private function validate_length() {
        // 
        $return_value = true;

        //
        foreach ($this->required_post_vars_length_array as $key => $value) {
            if (!has_length($_POST[$key], $value)) {
                MyValidationErrorLogger::log("{$key}::: should be between {$value['min']} to {$value['max']} characters.");

                $return_value = false;
            }
        }

        return $return_value;
    }

    // Validate the the POST vars contains something
    // that isn't just a white space.
    private function validate_white_space() {
        // 
        $return_value = true;

        //
        foreach ($this->required_post_vars_length_array as $key => $value) {
            // Validate presence.
            if (!has_presence($_POST[$key])) {
                MyValidationErrorLogger::log("{$key}::: can not be blank");

                $return_value = false;
            }
        }

        return $return_value;
    }

    private function check_required_post_vars_existence() {
        // White listing POST vars.
        if (are_post_vars_valid($this->allowed_post_vars_array)) {
            $can_proceed = true;
        } else {
            $can_proceed = false;
            MyValidationErrorLogger::log("are_vars_clean::: no. Incomplete and tampered");
        }
    }

    private function finalize_validation() {
        /* Here's I'll know if there's an error overall or not. */
        if (MyValidationErrorLogger::is_empty()) {
            // Proceed to the next validation step.
            $this->can_proceed = true;

//            $this->json_errors_array['is_result_ok'] = true;
        } else {
            $this->can_proceed = false;
        }
    }

    private function set_json_errors_array() {
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

    private function validate_csrf_token() {
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
