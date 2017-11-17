<?php

namespace App\Publico\Controller\PaypalPayment;

//require_once("ShippingOptionController.php");

//use App\Publico\Controller\ShippingOptions\ShippingOptionController;


if (isset($_GET["authenticate_paypal_seller_acount"]) && $_GET["authenticate_paypal_seller_acount"] == "yes") {

    // Instance

    // Validate


    // Do this for GET requests.

    //
    $is_validation_ok = true;
    $json_errors_array = array();



    /**/
    if ($is_validation_ok) {
        $json_errors_array["objs"] = null;

        //
        $json_errors_array["is_result_ok"] = true;
    }


    //
    echo json_encode($json_errors_array);
}
?>