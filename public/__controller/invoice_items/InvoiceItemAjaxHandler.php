<?php
namespace App\Publico\Controller\InvoiceItems;

require_once("InvoiceItemController.php");

use App\Publico\Controller\InvoiceItems\InvoiceItemController;
use App\Publico\Model\InvoiceItem;




if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $ii_controller = new InvoiceItemController();


    // Validate
    $allowed_assoc_indexes = array(
        "invoice_id"
    );

    $required_vars_length_array = array(
        "invoice_id" => ["min" => 8, "max" => 32]
    );


    // Do this for GET requests.
    $ii_controller->validator->set_request_type("get");


    //
    $ii_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $ii_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $ii_controller->validator->validate();
    $json_errors_array = $ii_controller->validator->get_json_errors_array();



    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }


        // Let the controller handle it.
        $json_errors_array['objs'] = $ii_controller->read($sanitized_vars);


        //
        if ($json_errors_array["objs"] != false) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

?>