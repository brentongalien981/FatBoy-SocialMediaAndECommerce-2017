<?php

use App\Privado\HelperClasses\Validation\Validator;


// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["delete_follow_notification_record"]) && $_POST["delete_follow_notification_record"] == "yes") {
    // Necessary arrays for validation.
    $allowed_assoc_indexes_for_post = array("notification_id");
    $required_post_vars_length_array = array("notification_id" => ["min" => 1, "max" => 14]);


    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);    

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok) {

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }






    if ($json_errors_array['is_result_ok']) {
        $is_deletion_ok = delete_follow_notification_record();

        if (!$is_deletion_ok) {
            $json_errors_array['is_result_ok'] = false;
        }
    }

    //
    echo json_encode($json_errors_array);
    return;
}


if (is_request_post() && isset($_POST["delete_follow_acceptance_record"]) && $_POST["delete_follow_acceptance_record"] == "yes") {
    // Necessary arrays for validation.
    $allowed_assoc_indexes_for_post = array("notification_id");
    $required_post_vars_length_array = array("notification_id" => ["min" => 1, "max" => 14]);


    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok) {

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }





    // TODO:REMINDER
    if ($json_errors_array['is_result_ok']) {
        $is_deletion_ok = delete_follow_acceptance_record();

        if (!$is_deletion_ok) {
            $json_errors_array['is_result_ok'] = false;
        }
    }

    //
    echo json_encode($json_errors_array);
    return;
}
?>





<?php
function delete_follow_acceptance_record() {
    //
    MyDebugMessenger::add_debug_message("Inside METHOD: delete_follow_acceptance_record().");
    //
    return NotificationFriendship::delete($_POST['notification_id']);
}

function delete_follow_notification_record() {
    //
    MyDebugMessenger::add_debug_message("Inside METHOD: delete_follow_notification_record().");
    //
    return NotificationFriendship::delete($_POST['notification_id']);
}
?>