<?php
namespace App\Publico\Controller\StoreCarts;

require_once("StoreCartController.php");

use App\Publico\Controller\StoreCarts\StoreCartController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $sc_controller = new StoreCartController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4]
    );


    // Do this for GET requests.
    $sc_controller->validator->set_request_type("get");


    //
    $sc_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $sc_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $sc_controller->validator->validate();
    $json_errors_array = $sc_controller->validator->get_json_errors_array();



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
        $json_errors_array["objs"] = $sc_controller->read($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) {
            $json_errors_array["is_result_ok"] = true;

            /**/
            global $session;

            if (isset($session->cart_id)) {
                $json_errors_array["cart_id"] = $session->cart_id;
            }
            else {
                $json_errors_array["cart_id"] = -69;
            }

        }
    }


    //
    echo json_encode($json_errors_array);
}

?>