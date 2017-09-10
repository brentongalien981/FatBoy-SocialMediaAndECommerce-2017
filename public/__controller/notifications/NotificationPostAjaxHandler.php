<?php
// TODO:
/*
 * TODO: This should be for the actual notifications for messages, comments responses
 *       for the main post.
 */
//namespace App\Publico\Controller\Notifications;
//
//require_once("NotificationPostController.php");
////require_once("NotificationFetcher.php");
//
//use App\Publico\Controller\Notifications\NotificationPostController;
//use App\Publico\Controller\Notifications\NotificationFetcher;

?>





<?php
//if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {
//
//
//    /* Validate */
//    $allowed_assoc_indexes = array("post_id", "notification_msg_id");
//    $required_vars_length_array = array(
//        "post_id" => ["min" => 1, "max" => 11],
//        "notification_msg_id" => ["min" => 1, "max" => 2]
//    );
//
//    $np_controller = new NotificationPostController();
//
//    $np_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
//    $np_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
//    $is_validation_ok = $np_controller->validator->validate();
//    $json_errors_array = $np_controller->validator->get_json_errors_array();
//
//
//    //
//    if ($is_validation_ok) {
//
//        // Prepare the necessary data to pass to the controller.
//        // Sanitized vars for passing to the controller.
//        $sanitized_vars = array();
//        foreach ($allowed_assoc_indexes as $index) {
//            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
//            $sanitized_vars[$index] = $_POST[$index];
//        }
//
//
//
//        // Let the controller handle it.
//        $is_creation_ok = $np_controller->create($sanitized_vars);
//
//        //
//        if ($is_creation_ok) {
//            $json_errors_array['is_result_ok'] = true;
//        }
//    }
//
//
//    //
//    echo json_encode($json_errors_array);
//}
//
//if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    // Instance
//    $np_controller = new NotificationPostController();
//
//
//    // Validate
//    $allowed_assoc_indexes = array("offset");
//    $required_vars_length_array = array("offset" => ["min" => 1, "max" => 14]);
//    // Do this for GET requests.
//    $np_controller->validator->set_request_type("get");
//    $np_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
//    $np_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
//    $is_validation_ok = $np_controller->validator->validate();
//    $json_errors_array = $np_controller->validator->get_json_errors_array();
//
//
//    if ($is_validation_ok) {
//        // Prepare the necessary data to pass to the controller.
//        // Sanitized vars for passing to the controller.
//        $sanitized_vars = array();
//        foreach ($allowed_assoc_indexes as $index) {
//            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
//            $sanitized_vars[$index] = $_GET[$index];
//        }
//
//
//
//        // Let the controller handle it.
//        $json_errors_array['notifications'] = $np_controller->read($sanitized_vars);
//
//
//        // If everything is ok.
////        if (isset($json_errors_array['notifications']) &&
////            $json_errors_array['notifications'] != null &&
////            count($json_errors_array['notifications']) > 0)
////        {
////
////            $json_errors_array['is_result_ok'] = true;
////
////        }
//        $json_errors_array['is_result_ok'] = true;
//    }
//
//
//    //
//    echo json_encode($json_errors_array);
//}
?>
