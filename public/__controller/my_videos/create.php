<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php");  ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_my_videos.php");  ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php

use App\Privado\HelperClasses\Validation\Validator;

// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["create_video"]) && $_POST["create_video"] == "yes") {
    //
    $allowed_assoc_indexes_for_post = array("video_title", "embedded_video_code");

// These values are for error logs.
    $json_errors_array = array("error_video_title" => "", "error_embedded_video_code" => "", "is_result_ok" => false, "error_csrf_token" => "", "error_are_vars_clean" => "", "validator_result" => "");







    // TODO:DEBUG
    $validator = new Validator();
    $x = $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);


    echo json_encode($validator->get_json_errors_array());
    return;
    
    
    
    
    
    
    
    
    



    $can_proceed = false;

    MyValidationErrorLogger::initialize();




    // Check csrf_token.
    if (is_csrf_token_legit()) {
        $can_proceed = true;

        // TODO:REMINDER: Delete this on production.
        $json_errors_array['POST_csrf_token'] = $_POST['csrf_token'];
        $json_errors_array['SESSION_csrf_token'] = $_SESSION['csrf_token'];
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



    // Try to add record to db.
    // TODO:REMINDER
    if ($can_proceed/* && create_like_record($allowed_assoc_indexes_for_post) */) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }






    // Validattion.
    validate_video_form();


    // If the code goes here, that means the validation passed.
    add_new_video_record_to_db();
}
?>





<?php

function validate_video_form() {
    //
    MyValidationErrorLogger::initialize();


    //
    $video_title = $_POST["video_title"];
    $embedded_video_code = $_POST["embedded_video_code"];

    // validations
    $required_fields = array("video_title", "embedded_video_code");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("video_title" => 100, "embedded_video_code" => 1000);
    validate_max_lengths($fields_with_max_lengths);


    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS video validation.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL video validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }

        redirect_to("../__view/view_my_videos.php");
    }
}
?>