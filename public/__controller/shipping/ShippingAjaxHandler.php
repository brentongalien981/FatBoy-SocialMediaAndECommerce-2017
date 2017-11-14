<?php

namespace App\Publico\Controller\Shipping;

require_once("ShippingController.php");

use App\Publico\Controller\Shipping\ShippingController;


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array(
        "shipping_street1",
//        "shipping_street2",
        "shipping_city",
        "shipping_state",
        "shipping_zip",
        "shipping_country_code",
        "shipping_phone"
    );


    $required_vars_length_array = array(
        "shipping_street1" => ["min" => 1, "max" => 500],
//        "shipping_street2" => ["min" => 1, "max" => 500],
        "shipping_city" => ["min" => 1, "max" => 100],
        "shipping_state" => ["min" => 1, "max" => 50],
        "shipping_zip" => ["min" => 1, "max" => 10],
        "shipping_country_code" => ["min" => 1, "max" => 2],
        "shipping_phone" => ["min" => 1, "max" => 20]
    );



    //
    $s_controller = new ShippingController();

    $s_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $s_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $s_controller->validator->validate();

    $json_errors_array = $s_controller->validator->get_json_errors_array();


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
        $is_crud_ok = $s_controller->create($sanitized_vars);

        //
        if ($is_crud_ok != false) {
            // Everything is ok.
            $json_errors_array["is_result_ok"] = true;
            $json_errors_array["SHIT_XXX_ship_to_address_id"] = $is_crud_ok;
        } else {
            $json_errors_array["crud_result_msg"] = "Sorry, but there was a problem with your shipping address details.";
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array["form_errors_showable"] = true;
    echo json_encode($json_errors_array);
}

?>