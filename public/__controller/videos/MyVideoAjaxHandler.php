<?php
namespace App\Publico\Controller\Videos;

require_once("MyVideoController.php");

use App\Publico\Controller\Videos\MyVideoController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $mv_controller = new MyVideoController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4]
    );


    // Do this for GET requests.
    $mv_controller->validator->set_request_type("get");


    //
    $mv_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $mv_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $mv_controller->validator->validate();
    $json_errors_array = $mv_controller->validator->get_json_errors_array();



    /**/
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
//        $json_errors_array["is_viewing_own_account"] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array["objs"] = $mv_controller->read($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['fetch']) && $_GET['fetch'] == "yes") {

    // Instance
    $mv_controller = new MyVideoController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit",
        "date_of_latest_obj"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4],
        "date_of_latest_obj" => ["min" => 19, "max" => 20]
    );


    // Do this for GET requests.
    $mv_controller->validator->set_request_type("get");


    //
    $mv_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $mv_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $mv_controller->validator->validate();
    $json_errors_array = $mv_controller->validator->get_json_errors_array();



    /**/
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
//        $json_errors_array["is_viewing_own_account"] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array["objs"] = $mv_controller->fetch($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("video_title", "src");
    $required_vars_length_array = array(
        "video_title" => ["min" => 5, "max" => 256],
        "src" => ["min" => 32, "max" => 1024]

    );


    //
    $vars_to_be_prefix_checked = array("src");

    //
    $video_controller = new MyVideoController();

    $video_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $video_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $video_controller->validator->set_vars_to_be_prefix_checked($vars_to_be_prefix_checked);

    $is_validation_ok = $video_controller->validator->validate();

    $json_errors_array = $video_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $video_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    // TODO
    sleep(3);

    /* Validate */
    $allowed_assoc_indexes = array("video_id", "video_title", "video_url");
    $required_vars_length_array = array(
        "video_id" => ["min" => 1, "max" => 11],
        "video_title" => ["min" => 5, "max" => 256],
        "video_url" => ["min" => 32, "max" => 1024]

    );


    //
    $vars_to_be_prefix_checked = array("video_url");

    //
    $video_controller = new MyVideoController();

    $video_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $video_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $video_controller->validator->set_vars_to_be_prefix_checked($vars_to_be_prefix_checked);

    $is_validation_ok = $video_controller->validator->validate();

    $json_errors_array = $video_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $video_controller->update($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {

    // TODO
    sleep(3);

    /* Validate */
    $allowed_assoc_indexes = array("video_id");
    $required_vars_length_array = array(
        "video_id" => ["min" => 1, "max" => 11]

    );



    //
    $video_controller = new MyVideoController();

    $video_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $video_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $video_controller->validator->validate();

    $json_errors_array = $video_controller->validator->get_json_errors_array();


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
        $is_deletion_ok = $video_controller->delete($sanitized_vars);

        //
        if ($is_deletion_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}


?>