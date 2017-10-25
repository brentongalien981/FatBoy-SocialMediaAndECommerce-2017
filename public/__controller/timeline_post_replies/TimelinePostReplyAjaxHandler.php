<?php

namespace App\Publico\Controller\TimelinePostReplies;

require_once("TimelinePostReplyController.php");

use App\Publico\Controller\TimelinePostReplies\TimelinePostReplyController;
use App\Publico\Model\TimelinePostReply;


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("parent_post_id", "message");
    $required_vars_length_array = array(
        "parent_post_id" => ["min" => 1, "max" => 11],
        "message" => ["min" => 1, "max" => 1000]

    );

    //
    $tpr_controller = new TimelinePostReplyController();

    $tpr_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tpr_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $is_validation_ok = $tpr_controller->validator->validate();

    $json_errors_array = $tpr_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $tpr_controller->create($sanitized_vars);

        // If the returned value is not false,
        // meaning it is the new timeline-post-reply-id.
        if ($is_creation_ok != false) {

            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;

            //
            $timeline_post_reply_id = $is_creation_ok;
            $json_errors_array["timeline_post_reply_id"] = $timeline_post_reply_id;

            //
            $json_errors_array["parent_post_id"] = $sanitized_vars["parent_post_id"];

        }
    }


    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {
    // Instance
    $tpr_controller = new TimelinePostReplyController();


    // Validate
    $allowed_assoc_indexes = array(
        "timeline_post_id"
    );

    $required_vars_length_array = array(
        "timeline_post_id" => ["min" => 1, "max" => 11]
    );


    // Do this for GET requests.
    $tpr_controller->validator->set_request_type("get");


    //
    $tpr_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tpr_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $tpr_controller->validator->validate();
    $json_errors_array = $tpr_controller->validator->get_json_errors_array();



    //
    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }

//        //
//        global $session;
//        $json_errors_array['is_viewing_own_account'] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array["objs"] = $tpr_controller->read($sanitized_vars);


        // Should reading of the objs here always be ok? Well no..
        if ($json_errors_array["objs"] != null) {
            $json_errors_array["is_result_ok"] = true;
            $json_errors_array["timeline_post_id"] = $sanitized_vars["timeline_post_id"];
        }

    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['fetch']) && $_GET['fetch'] == "yes") {
    // Instance
    $tpr_controller = new TimelinePostReplyController();


    // Validate
    $allowed_assoc_indexes = array(
        "timeline_post_id",
        "offset",
        "latest_comment_date"
    );

    $required_vars_length_array = array(
        "timeline_post_id" => ["min" => 1, "max" => 11],
        "offset" => ["min" => 1, "max" => 11],
        "latest_comment_date" => ["min" => 19, "max" => 20]
    );


    // Do this for GET requests.
    $tpr_controller->validator->set_request_type("get");


    //
    $tpr_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tpr_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $tpr_controller->validator->validate();
    $json_errors_array = $tpr_controller->validator->get_json_errors_array();



    //
    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }

//        //
//        global $session;
//        $json_errors_array['is_viewing_own_account'] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array["objs"] = $tpr_controller->fetch($sanitized_vars);


        // Should reading of the objs here always be ok? Well no..
        if ($json_errors_array["objs"] != null) {
            $json_errors_array["is_result_ok"] = true;
            $json_errors_array["timeline_post_id"] = $sanitized_vars["timeline_post_id"];
        }

    }


    //
    echo json_encode($json_errors_array);
}

?>