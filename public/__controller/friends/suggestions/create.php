<?php

use App\Privado\HelperClasses\Validation\Validator;

if (is_request_post() && isset($_POST["create_friendship_notification"]) && $_POST["create_friendship_notification"] == "yes") {

    /* Validate */
    $json_errors_array = validate_me();

    // If there's a problem with the validation or
    // the creation, then return false.
    if (!(($json_errors_array['is_result_ok']) &&
            (create_friendship_notification()))) {
        $json_errors_array['is_result_ok'] = false;
    }

    //
    echo json_encode($json_errors_array);
    return;
}

if (is_request_post() && isset($_POST["create_follow_record"]) && $_POST["create_follow_record"] == "yes") {

    /* Validate */
    $json_errors_array = validate_me();

    // If there's a problem with the validation or
    // the creation, then return false.
    if (!(($json_errors_array['is_result_ok']) &&
            (create_follow_record()))) {
        $json_errors_array['is_result_ok'] = false;
    }

    //
    echo json_encode($json_errors_array);
    return;
}
?>





<?php

function create_friendship_notification() {
    //
    global $session;

    $notification = new NotificationFriendship();
    $notification->id = null;
    $notification->notified_user_id = $_POST["friend_id"];
    $notification->notifier_user_id = $session->actual_user_id;
    $notification->notification_msg_id = 2; // 2 is {NotifierUserName} wants to follow you.
    $notification->is_deleted = false;

    $is_creation_ok = $notification->create_with_bool();

    return $is_creation_ok;
}

function create_follow_record() {
    global $session;

    MyDebugMessenger::add_debug_message("A new friendship is about to be born.");

    $new_friendship = new Friendship();
    $new_friendship->user_id = $session->actual_user_id;
    $new_friendship->friend_id = $_POST['friend_id'];

    $is_creation_ok = $new_friendship->create_with_bool();
    
//    uki
//    CentralController::delete_follow_request_notification();
    
    return $is_creation_ok;
}

function get_validator_obj(&$allowed_assoc_indexes_for_post) {
    //
    $required_post_vars_length_array = array("friend_id" => ["min" => 1, "max" => 11]);

//
    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);

    return $validator;
}

/**
 * 
 * @return array $json_errors_array
 */
function validate_me() {
    $allowed_assoc_indexes_for_post = array("friend_id");

    $validator = get_validator_obj($allowed_assoc_indexes_for_post);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok) {

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }


    //
    return $json_errors_array;
}
?>