<?php
namespace App\Publico\Controller\Invoices;

require_once("InvoiceController.php");

use App\Publico\Controller\Invoices\InvoiceController;
use App\Publico\Model\Invoice;




if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $i_controller = new InvoiceController();


    // Validate
    $allowed_assoc_indexes = array(
        "offset"
    );

    $required_vars_length_array = array(
        "offset" => ["min" => 1, "max" => 16]
    );


    // Do this for GET requests.
    $i_controller->validator->set_request_type("get");


    //
    $i_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $i_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $i_controller->validator->validate();
    $json_errors_array = $i_controller->validator->get_json_errors_array();



    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }


        // Let the controller handle it.
        $json_errors_array['objs'] = $i_controller->read($sanitized_vars);


        //
        if ($json_errors_array["objs"] != false) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

?>