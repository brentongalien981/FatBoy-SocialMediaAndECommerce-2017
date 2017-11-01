<?php
namespace App\Publico\Controller\StoreItems;

require_once("StoreItemController.php");

use App\Publico\Controller\StoreItems\StoreItemController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $si_controller = new StoreItemController();


    // Validate
    $allowed_assoc_indexes = array(
        "offset"
    );

    $required_vars_length_array = array(
        "offset" => ["min" => 1, "max" => 7]
    );


    // Do this for GET requests.
    $si_controller->validator->set_request_type("get");


    //
    $si_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $si_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $si_controller->validator->validate();
    $json_errors_array = $si_controller->validator->get_json_errors_array();



    /**/
    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }

        //
        global $session;
        $json_errors_array['is_viewing_own_account'] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array["objs"] = $si_controller->read($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) { $json_errors_array["is_result_ok"] = true; }
    }


    //
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array(
        "product_name",
        "product_price",
        "product_quantity",
        "product_description",
        "product_photo_src",
        "product_mass",
        "product_length",
        "product_width",
        "product_height",
    );

    $required_vars_length_array = array(
        "product_name" => ["min" => 1, "max" => 100],
        "product_price" => ["min" => 1, "max" => 32],
        "product_quantity" => ["min" => 1, "max" => 11],
        "product_description" => ["min" => 1, "max" => 3000],
        "product_photo_src" => ["min" => 1, "max" => 1000],
        "product_mass" => ["min" => 1, "max" => 32],
        "product_length" => ["min" => 1, "max" => 32],
        "product_width" => ["min" => 1, "max" => 32],
        "product_height" => ["min" => 1, "max" => 32]
    );

    $vars_to_be_number_uniformly_checked = array("product_quantity");

    $vars_to_be_of_decimal_value_checked = array(
        "product_price",
        "product_mass",
        "product_length",
        "product_width",
        "product_height"
    );

    $vars_to_be_of_min_value_checked = array(
        "product_price" => 0.01,
        "product_mass" => 0.01,
        "product_length" => 0.01,
        "product_width" => 0.01,
        "product_height" => 0.01
    );


    //
    $si_controller = new StoreItemController();

    $si_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $si_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $si_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);
    $si_controller->validator->set_vars_to_be_of_decimal_value_checked($vars_to_be_of_decimal_value_checked);
    $si_controller->validator->set_vars_to_be_of_min_value_checked($vars_to_be_of_min_value_checked);



    $is_validation_ok = $si_controller->validator->validate();

    $json_errors_array = $si_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $si_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array["is_result_ok"] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array["form_errors_showable"] = true;
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array(
        "product_id",
        "product_name",
        "product_price",
        "product_quantity",
        "product_description",
        "product_photo_src",
        "product_mass",
        "product_length",
        "product_width",
        "product_height",
    );

    $required_vars_length_array = array(
        "product_id" => ["min" => 1, "max" => 11],
        "product_name" => ["min" => 1, "max" => 100],
        "product_price" => ["min" => 1, "max" => 32],
        "product_quantity" => ["min" => 1, "max" => 11],
        "product_description" => ["min" => 1, "max" => 3000],
        "product_photo_src" => ["min" => 1, "max" => 1000],
        "product_mass" => ["min" => 1, "max" => 32],
        "product_length" => ["min" => 1, "max" => 32],
        "product_width" => ["min" => 1, "max" => 32],
        "product_height" => ["min" => 1, "max" => 32]
    );

    $vars_to_be_number_uniformly_checked = array("product_id", "product_quantity");

    $vars_to_be_of_decimal_value_checked = array(
        "product_price",
        "product_mass",
        "product_length",
        "product_width",
        "product_height"
    );

    $vars_to_be_of_min_value_checked = array(
        "product_price" => 0.01,
        "product_mass" => 0.01,
        "product_length" => 0.01,
        "product_width" => 0.01,
        "product_height" => 0.01
    );


    //
    $si_controller = new StoreItemController();

    $si_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $si_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $si_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);
    $si_controller->validator->set_vars_to_be_of_decimal_value_checked($vars_to_be_of_decimal_value_checked);
    $si_controller->validator->set_vars_to_be_of_min_value_checked($vars_to_be_of_min_value_checked);



    $is_validation_ok = $si_controller->validator->validate();

    $json_errors_array = $si_controller->validator->get_json_errors_array();


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
        $is_update_ok = $si_controller->update($sanitized_vars);

        //
        if ($is_update_ok) {
            // Everything is ok.
            $json_errors_array["is_result_ok"] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array["form_errors_showable"] = true;
    echo json_encode($json_errors_array);
}
?>