<?php

namespace App\Publico\Controller\PaypalPayment;

require_once("PaypalPaymentController.php");

use App\Publico\Controller\PaypalPayment\PaypalPaymentController;


if (isset($_POST["authenticate_paypal_seller_acount"]) && $_POST["authenticate_paypal_seller_acount"] == "yes") {
//if (isset($_GET["authenticate_paypal_seller_acount"]) && $_GET["authenticate_paypal_seller_acount"] == "yes") {

//    $paypal_payment_preparation_result_msg = "Redirected from FILE: PaypalPaymentAjaxHandler.php.";
//    redirect_to(LOCAL . "/public/__view/paypal_payment/payment_preparation_result.php?paypal_payment_preparation_result_msg={$paypal_payment_preparation_result_msg}");

    // Instance
    $pp_controller = new PaypalPaymentController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit",
        "shipping_fee"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4]
    );


//    // Do this for GET requests.
//    $pp_controller->validator->set_request_type("get");


    //
    $pp_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $pp_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $pp_controller->validator->validate();
    $json_errors_array = $pp_controller->validator->get_json_errors_array();



    /**/
    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }


        // Let the controller handle it.
        $pp_controller->read($sanitized_vars);

    }
}

?>