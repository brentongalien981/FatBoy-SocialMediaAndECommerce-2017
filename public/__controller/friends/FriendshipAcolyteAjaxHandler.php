<?php
namespace App\Publico\Controller\Friends;

require_once("FriendshipAcolyteController.php");

use App\Publico\Controller\Friends\FriendshipAcolyteController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => true, "handler_file" => "FriendshipAcolyteAjaxHandler.php"));
//    return;



    /* Validate */
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);


    // Instance
    $f_acolyte_controller = new FriendshipAcolyteController();



    // Do this for GET requests.
    $f_acolyte_controller->validator->set_request_type("get");
    $f_acolyte_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $f_acolyte_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $f_acolyte_controller->validator->validate();
    $json_errors_array = $f_acolyte_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['x_friends'] = $f_acolyte_controller->read($sanitized_vars);


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