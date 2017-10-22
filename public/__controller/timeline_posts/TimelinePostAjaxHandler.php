<?php
namespace App\Publico\Controller\TimelinePosts;

require_once("TimelinePostController.php");

use App\Publico\Controller\TimelinePosts\TimelinePostController;
use App\Publico\Model\TimelinePost;


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("message");
    $required_vars_length_array = array(
        "message" => ["min" => 1, "max" => 1000]

    );

    //
    $tp_controller = new TimelinePostController();

    $tp_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tp_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $is_validation_ok = $tp_controller->validator->validate();

    $json_errors_array = $tp_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $tp_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {
    // Instance
    $tp_controller = new TimelinePostController();

    // Default value.
    $json_errors_array = array();

    // Let the controller handle it.
    $json_errors_array['objs'] = $tp_controller->read();


    //
    if ($json_errors_array['objs'] != false) {
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['fetch']) && $_GET['fetch'] == "yes") {
    // Instance
    $tp_controller = new TimelinePostController();


    // Validate
    $allowed_assoc_indexes = array("latest_timeline_post_date");
    $required_vars_length_array = array("latest_timeline_post_date" => ["min" => 19, "max" => 20]);
    // Do this for GET requests.
    $tp_controller->validator->set_request_type("get");
    $tp_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tp_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $tp_controller->validator->validate();
    $json_errors_array = $tp_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['objs'] = $tp_controller->fetch($sanitized_vars);

        //
        global $session;
        $json_errors_array["is_user_viewing_own_account"] = $session->is_viewing_own_account();


        //
        if ($json_errors_array['objs'] != false) {
            $json_errors_array['is_result_ok'] = true;
//            $json_errors_array['actual_user_id'] = $session->actual_user_id;
        }

    }


    //
    echo json_encode($json_errors_array);
}
?>