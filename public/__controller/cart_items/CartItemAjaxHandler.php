<?php
namespace App\Publico\Controller\CartItems;

require_once("CartItemController.php");

use App\Publico\Controller\CartItems\CartItemController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $ci_controller = new CartItemController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4]
    );


    // Do this for GET requests.
    $ci_controller->validator->set_request_type("get");


    //
    $ci_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $ci_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $ci_controller->validator->validate();
    $json_errors_array = $ci_controller->validator->get_json_errors_array();



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
        $json_errors_array["objs"] = $ci_controller->read($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array(
        "new_quantity",
        "cart_item_id",
        "store_item_id"
    );

    $required_vars_length_array = array(
        "new_quantity" => ["min" => 1, "max" => 11],
        "cart_item_id" => ["min" => 1, "max" => 11],
        "store_item_id" => ["min" => 1, "max" => 11]
    );

    $vars_to_be_number_uniformly_checked = array("product_id", "product_quantity");


    //
    $ci_controller = new CartItemController();

    $ci_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $ci_controller->validator->set_required_post_vars_length_array($required_vars_length_array);



    $is_validation_ok = $ci_controller->validator->validate();

    $json_errors_array = $ci_controller->validator->get_json_errors_array();


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
        $is_update_ok = $ci_controller->update($sanitized_vars);

        //
        if ($is_update_ok) {
            // Everything is ok.
            $json_errors_array["is_result_ok"] = true;
        }
        else {
            $json_errors_array["update_result_msg"] = "Sorry, but that value currently exceeds our stock quantity.";
        }
    }


//    // This is to let the user see the errors on their forms.
//    $json_errors_array["form_errors_showable"] = true;
    echo json_encode($json_errors_array);
}

?>