<?php

use App\Privado\HelperClasses\Validation\Validator;

// TODO:REMINDER: Validate the format of the embed code on the next iteration.
// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["create_follow_acceptance_notification"]) && $_POST["create_follow_acceptance_notification"] == "yes") {
    // Necessary arrays for validation.
    $allowed_assoc_indexes_for_post = array("friend_id");
    $required_post_vars_length_array = array("friend_id" => ["min" => 1, "max" => 11]);


    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    
    //
    if ($json_errors_array['is_result_ok']) {
        $is_creation_ok = create_follow_acceptance_notification();

        if (!$is_creation_ok) {
            $json_errors_array['is_result_ok'] = false;
        }
    }

    //
    echo json_encode($json_errors_array);
    return;
}
?>






<?php
function create_follow_acceptance_notification() {
    //
    global $session;

    $notification = new NotificationFriendship();
    $notification->id = null;
    $notification->notified_user_id = $_POST["friend_id"];
    $notification->notifier_user_id = $session->actual_user_id;
    $notification->notification_msg_id = 3; // 3 is {NotifierUserName} accepted your follow request.
    $notification->is_deleted = false;

    $is_creation_ok = $notification->create_with_bool();

    return $is_creation_ok;
}
?>