<?php
namespace App\Publico\Controller\Notifications;

require_once("NotificationRateableItemController.php");

use App\Publico\Controller\Notifications\NotificationRateableItemController;

?>





<?php
if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {


    /* Validate */
    $allowed_assoc_indexes = array("rateable_item_id", "notification_msg_id", "rate_value");
    $required_vars_length_array = array(
        "rateable_item_id" => ["min" => 1, "max" => 12],
        "notification_msg_id" => ["min" => 1, "max" => 2],
        "rate_value" => ["min" => 1, "max" => 2]
    );

    $nri_controller = new NotificationRateableItemController();

    $nri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nri_controller->validator->validate();
    $json_errors_array = $nri_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }



        // Let the controller handle it.
        $is_creation_ok = $nri_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            $json_errors_array['is_result_ok'] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {
    // Instance
    $nri_controller = new NotificationRateableItemController();


    // Validate
    $allowed_assoc_indexes = array("offset");
    $required_vars_length_array = array("offset" => ["min" => 1, "max" => 3]);
    // Do this for GET requests.
    $nri_controller->validator->set_request_type("get");
    $nri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nri_controller->validator->validate();
    $json_errors_array = $nri_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $nri_controller->read($sanitized_vars);


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
    $nri_controller = new NotificationRateableItemController();


    // Validate
    $allowed_assoc_indexes = array("latest_notification_date");
    $required_vars_length_array = array("latest_notification_date" => ["min" => 19, "max" => 20]);
    // Do this for GET requests.
    $nri_controller->validator->set_request_type("get");
    $nri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nri_controller->validator->validate();
    $json_errors_array = $nri_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $nri_controller->fetch($sanitized_vars);


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

if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("notification_id");
    $required_vars_length_array = array(
        "notification_id" => ["min" => 1, "max" => 13]
    );

    $nri_controller = new NotificationRateableItemController();

    $nri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nri_controller->validator->validate();
    $json_errors_array = $nri_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }



        // Let the controller handle it.
        $is_deletion_ok = $nri_controller->delete($sanitized_vars);

        //
        $json_errors_array['is_result_ok'] = $is_deletion_ok;
    }


    //
    echo json_encode($json_errors_array);
}
?>
