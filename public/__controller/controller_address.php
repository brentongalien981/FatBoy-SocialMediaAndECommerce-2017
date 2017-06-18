<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once("../__model/session.php"); ?>
<?php require_once("../__model/model_address.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_timeline_posts.php");      ?>

<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php

// Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("../index.php");
}
?>





<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php

// TODO: NOW
//$can_procced = false;
// For adding address.
if (is_request_post() && isset($_POST["add_address"]) && $_POST["add_address"] == "yes") {
    $allowed_assoc_indexes_for_post = array('street1', 'street2', 'city', 'state', 'zip', 'country_code', 'address_type_code');

// These value are for error logs.
    $json_errors_array = array("error_street1" => "", "error_street2" => "", "error_city" => "", "error_state" => "", "error_zip" => "", "error_country_code" => "", "error_address_type_code" => "", "is_address_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "");

    MyValidationErrorLogger::initialize();

    $dirty_array = [];
    $sanitized_array = [];
    $can_proceed = false;


    // Check csrf_token.
    if (is_csrf_token_legit()) {
        $can_proceed = true;
//        $json_errors_array['csrf_token'] = "ok";
    } else {
        $can_proceed = false;
//        echo "0";
    }


    // White listing POST vars.
    $dirty_array = are_post_vars_valid($allowed_assoc_indexes_for_post);
    if ($can_proceed && $dirty_array != 0) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
//        echo "0";
    }


    // Validate inputs.
    $var_lengts_arr = array("street1" => ["min" => 2, "max" => 500],
                            "street2" => ["min" => 2, "max" => 500],
                            "city" => ["min" => 2, "max" => 100],
                            "state" => ["min" => 2, "max" => 50],
                            "zip" => ["min" => 2, "max" => 10],
                            "country_code" => ["min" => 2, "max" => 2],
                            "address_type_code" => ["min" => 1, "max" => 1]);
    
    if ($can_proceed && validate_vars_lengths($var_lengts_arr)) {
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }





    /* Here's I'll know if there's an error overall or not. */
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        $can_proceed = true;
    } else {
        $can_proceed = false;
    }

    /* Log the errors. */
    // Put to the JSON array the first error for each error type.
    // Here, basically, one $log_error_msg is like:
    //      csrf_token::: not valid
    // So the returned json_error_array will have:
    //      json.error_csrf_token => "* not valid"
    foreach (MyValidationErrorLogger::get_log_array() as $log_error_msg) {
        MyDebugMessenger::add_debug_message($log_error_msg);
        // Find which field that error is based on "field::: is bad" log_error_msg.
        // $pos = position of :::
        $pos = strpos($log_error_msg, ":::");

        $error_field = "error_" . substr($log_error_msg, 0, $pos);

        // If the error_field in the $json_errors_array doesn't have value yet,
        // add the log_error_msg.
        if ($json_errors_array[$error_field] == "") {
            $json_errors_array[$error_field] = "* " . substr($log_error_msg, $pos + 4);
        }
    }


    MyValidationErrorLogger::reset();

    
    
    if ($can_proceed) {
        // Everything is ok. So redirect to log-in. No need for the json errors.
        $json_errors_array['is_address_ok'] = true;
    }

    echo json_encode($json_errors_array);
}






if (isset($_POST["populate_address"]) && $_POST["populate_address"] == "yes") {
    populate_address();
}

if (isset($_POST["show_address_button"]) && $_POST["show_address_button"] == "yes") {
    show_address_button($_POST['has_address']);
}




if (isset($_POST["save_address"])) {
    // Kind of encode the vars in a form that is
    // harmless to db. Avoid SQL injection.    
    $street1 = $_POST["street1"];
    $street2 = $_POST["street2"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $country_code = $_POST["country_code"];
    $address_type_code = $_POST["address_type_code"];


    // Validation time.
    MyValidationErrorLogger::initialize();

    // Check if the fields are empty.
    $required_fields = array("street1", "city", "state", "zip", "country_code", "address_type_code");
    validate_presences($required_fields);


    // Check the length of the input data.
    $fields_with_max_lengths = array("street1" => 500, "street2" => 500, "city" => 100, "state" => 50, "zip" => 10, "country_code" => 50);
    validate_max_lengths($fields_with_max_lengths);

// What you should be checking here is that,
// if the MyValidationErrorLogger is not empty, then ask again for credentials.
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS Address validation.");

        $can_procced = true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL Address validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        redirect_to("../__view/view_profile.php");
    }
}


//if ($can_procced) {
//    $new_address = new Address();
//
//
//    $new_address->id = null;
//    $new_address->user_id = $session->actual_user_id;
//    $new_address->street1 = $street1;
//    $new_address->street2 = $street2;
//    $new_address->city = $city;
//    $new_address->state = $state;
//    $new_address->zip = $zip;
//    $new_address->address_type_code = $address_type_code;
//    $new_address->country_code = $country_code;
//    $new_address->phone = null;
//
//    $address_creation_result_flag = $new_address->create_with_bool();
//
//
//    if ($address_creation_result_flag) {
//        MyDebugMessenger::add_debug_message("SUCCESS creation and insertion of an address record.");
//    } else {
//        MyDebugMessenger::add_debug_message("FAIL creation and insertion of an address record.");
//    }
//
//
//    redirect_to("../__view/view_profile.php");
//}
?>






<?php

// Use only allowable GET and POST variables. 
// Maybe put an array like: $allowed_gets = array();
// @return:
//      - valid POST arrays, or
//      - 0 if there's any tampered/invalid var.
function are_post_vars_valid($allowed_assoc_indexes_for_post) {
    $dirty_array = array();

    foreach ($allowed_assoc_indexes_for_post as $assoc_index) {

        if (isset($_POST[$assoc_index])) {
            $dirty_array[$assoc_index] = $_POST[$assoc_index];
//            MyValidationErrorLogger::log("post_vars::: {$assoc_index} ok.");
        } else {
            MyValidationErrorLogger::log("are_vars_clean::: no. Incomplete and tampered");
            return 0;
        }
    }

    return $dirty_array;
}

// @param $var_lengts_arr: Post vars that need their length validated.
function validate_vars_lengths($var_lengts_arr) {

    //
    foreach ($var_lengts_arr as $key => $value) {
        // Validate presence.
        if (!has_presence($_POST[$key])) {
            MyValidationErrorLogger::log("{$key}::: can not be blank");
            
            return false;
        }
        
        // Validate the length.   
        if (!has_length($_POST[$key], $value)) {
            MyValidationErrorLogger::log("{$key}::: should be between {$value['min']} to {$value['max']} characters.");
            
            // 1 mistake alone, return false right away.
            return false;
        }
    }
    
    // If all tests passed.
    return true;

}

function is_csrf_token_legit() {
    if (is_csrf_token_valid()) {
//        MyValidationErrorLogger::log("csrf_token::: valid.");

        if (is_csrf_token_recent()) {
//            MyValidationErrorLogger::log("csrf_token::: recent.");
            return true;
        } else {
            MyValidationErrorLogger::log("csrf_token::: not recent.");
            return false;
        }
    } else {
        MyValidationErrorLogger::log("csrf_token::: invalid.");
        return false;
    }
}

function populate_address() {
    global $session;
    $home_address_obj = Address::read_by_id($session->currently_viewed_user_id);


    // Display the address.
    if (isset($home_address_obj)) {
        echo json_encode($home_address_obj);
//        echo "<h5>";
//        echo "{$home_address_obj->street1}, {$home_address_obj->city}<br>{$home_address_obj->state}, {$home_address_obj->zip}, {$home_address_obj->country_code}";
//        if ($home_address_obj->phone != "") {
//            echo ", {$home_address_obj->phone}";
//        }
//        echo "</h5>";
    } else {
//        echo "<h5>n/a</h5>";
        echo "0";
    }
}

function show_address_button($has_address) {
    global $session;
    //
    if ($session->is_viewing_own_account()) {
        // If actual user already has an address, 
        // show the edit button.
        if ($has_address == "yes") {
            echo "<button class='form_button address_action_button' myAction='edit'>* edit address</button>";
        }
        // Actual user doesn't have an address yet,
        // so show the add button.
        else {
            echo "<button class='form_button address_action_button' myAction='add'>+ add address</button>";
        }
    } else {
        echo "0";
    }
}
?>