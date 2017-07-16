<?php
namespace App\Publico\Controller\Friends;

require_once("FriendshipMuseController.php");

use App\Publico\Controller\Friends\FriendshipMuseController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => true, "handler_file" => "FriendshipAcolyteAjaxHandler.php"));
//    return;



    /* Validate */
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);


    // Instance
    $f_muse_controller = new FriendshipMuseController();



    // Do this for GET requests.
    $f_muse_controller->validator->set_request_type("get");
    $f_muse_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $f_muse_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $f_muse_controller->validator->validate();
    $json_errors_array = $f_muse_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['x_friends'] = $f_muse_controller->read($sanitized_vars);


        // If everything is ok.
        if (isset($json_errors_array['x_friends']) &&
            $json_errors_array['x_friends'] != null &&
            count($json_errors_array['x_friends']) > 0)
        {

            $json_errors_array['is_result_ok'] = true;

        }
    }


    // AJAX return.
    echo json_encode($json_errors_array);
}




if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {
    /* Validate */
    $allowed_assoc_indexes = array("muse_user_id");
    $required_vars_length_array = array(
        "muse_user_id" => ["min" => 1, "max" => 11]
    );

    $f_muse_controller = new FriendshipMuseController();

    $f_muse_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $f_muse_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $f_muse_controller->validator->validate();
    $json_errors_array = $f_muse_controller->validator->get_json_errors_array();


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
        $is_deletion_ok = $f_muse_controller->delete($sanitized_vars);

        //
        if ($is_deletion_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}