<?php
namespace App\Publico\Controller\Friends;

require_once("FriendshipController.php");

use App\Publico\Controller\Friends\FriendshipController;



if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("friend_id", "notification_id", "notification_msg_id");
    $required_vars_length_array = array(
        "friend_id" => ["min" => 1, "max" => 11],
        "notification_id" => ["min" => 1, "max" => 14],
        "notification_msg_id" => ["min" => 1, "max" => 3]
    );

    $f_controller = new FriendshipController();

    $f_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $f_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $f_controller->validator->validate();
    $json_errors_array = $f_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }


//        // TODO:DEBUG
//        $json_errors_array['is_result_ok'] = true;
//        $json_errors_array['SO_FAR_SO_GOOD'] = true;
//        echo json_encode($json_errors_array);
//        return;



        // Let the controller handle it.
        $is_creation_ok = $f_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            $json_errors_array['is_result_ok'] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}