<?php
namespace App\Publico\Controller\Notifications;

require_once("NotificationFriendshipController.php");
require_once("NotificationFetcher.php");

use App\Publico\Controller\Notifications\NotificationFriendshipController;
use App\Publico\Controller\Notifications\NotificationFetcher;
?>





<?php
// AJAX Handler.
if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {
//    // TODO:DEBUG
//    echo json_encode(array("is_result_ok" => false));
//    return;

    /* Validate */
    $allowed_assoc_indexes = array("notification_id");
    $required_vars_length_array = array(
        "notification_id" => ["min" => 1, "max" => 13]
    );

    $n_friendship_controller = new NotificationFriendshipController();

    $n_friendship_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_friendship_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_friendship_controller->validator->validate();
    $json_errors_array = $n_friendship_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;




        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }



        // Let the controller handle it.
        $is_deletion_ok = $n_friendship_controller->delete($sanitized_vars);

        //
        if (!$is_deletion_ok) {
            $json_errors_array['is_result_ok'] = false;
        }
    }


    //
    echo json_encode($json_errors_array);
}


if (isset($_GET['update']) && $_GET['update'] == "yes") {
//    // TODO:DEBUG
//    echo json_encode(array("is_result_ok" => false));
//    return;


    /* Validate */
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);


    // Instance
    $n_friendship_controller = new NotificationFriendshipController();



    // Do this for GET requests.
    $n_friendship_controller->validator->set_request_type("get");
    $n_friendship_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_friendship_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_friendship_controller->validator->validate();
    $json_errors_array = $n_friendship_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $n_friendship_controller->update_fetch($sanitized_vars);


        // If everything is ok.
        if (isset($json_errors_array['notifications']) &&
            $json_errors_array['notifications'] != null &&
            count($json_errors_array['notifications']) > 0)
        {

            $json_errors_array['is_result_ok'] = true;

        }
    }


    // AJAX return.
    echo json_encode($json_errors_array);
}



if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {


    /* Validate */
    $allowed_assoc_indexes = array("friend_id", "notification_msg_id");
    $required_vars_length_array = array(
        "friend_id" => ["min" => 1, "max" => 11],
        "notification_msg_id" => ["min" => 1, "max" => 2]
    );

    $n_friendship_controller = new NotificationFriendshipController();

    $n_friendship_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_friendship_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_friendship_controller->validator->validate();
    $json_errors_array = $n_friendship_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {
        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;




        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }



        // Let the controller handle it.
        $is_creation_ok = $n_friendship_controller->create($sanitized_vars);

        //
        if (!$is_creation_ok) {
            $json_errors_array['is_result_ok'] = false;
        }
    }


    //
    echo json_encode($json_errors_array);
}


if (isset($_GET['read']) && $_GET['read'] == "yes") {
    // Instance
    $nf_controller = new NotificationFriendshipController();


    // Validate
    $allowed_assoc_indexes = array("offset");
    $required_vars_length_array = array("offset" => ["min" => 1, "max" => 3]);
    // Do this for GET requests.
    $nf_controller->validator->set_request_type("get");
    $nf_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nf_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nf_controller->validator->validate();
    $json_errors_array = $nf_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $nf_controller->read($sanitized_vars);


        // If everything is ok.
//        if (isset($json_errors_array['notifications']) &&
//            $json_errors_array['notifications'] != null &&
//            count($json_errors_array['notifications']) > 0)
//        {
//
//            $json_errors_array['is_result_ok'] = true;
//
//        }
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['fetch']) && $_GET['fetch'] == "yes") {
    // Instance
    $nf_controller = new NotificationFriendshipController();


    // Validate
    $allowed_assoc_indexes = array("latest_notification_date");
    $required_vars_length_array = array("latest_notification_date" => ["min" => 19, "max" => 20]);
    // Do this for GET requests.
    $nf_controller->validator->set_request_type("get");
    $nf_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nf_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nf_controller->validator->validate();
    $json_errors_array = $nf_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $nf_controller->fetch($sanitized_vars);


        // If everything is ok.
//        if (isset($json_errors_array['notifications']) &&
//            $json_errors_array['notifications'] != null &&
//            count($json_errors_array['notifications']) > 0)
//        {
//
//            $json_errors_array['is_result_ok'] = true;
//
//        }
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}


if (isset($_GET["get_all_notifications_count"]) &&
    ($_GET["get_all_notifications_count"] == "yes")) {

    //
    require_once(PUBLIC_PATH . "/__model/NotificationMyShopping.php");
    require_once(PUBLIC_PATH . "/__model/NotificationFriendship.php");
    require_once(PUBLIC_PATH . "/__model/NotificationRateableItem.php");
    require_once(PUBLIC_PATH . "/__model/NotificationTimelinePostReply.php");

    $notification_count = NotificationFetcher::get_all_notification_count();

    echo json_encode(array("is_result_ok" => true, "notification_count" => $notification_count));

}
?>