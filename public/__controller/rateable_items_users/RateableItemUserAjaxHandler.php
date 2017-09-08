<?php
namespace App\Publico\Controller\RateableItemsUsers;

require_once("RateableItemUserController.php");


use App\Publico\Controller\RateableItemsUsers\RateableItemUserController;

?>

<?php
if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("rateable_item_id", "rate_value");
    $required_vars_length_array = array(
        "rateable_item_id" => ["min" => 1, "max" => 12],
        "rate_value" => ["min" => 1, "max" => 2]

    );

    $vars_to_be_number_uniformly_checked = array("rateable_item_id", "rate_value");


    //
    $riu_controller = new RateableItemUserController();

    $riu_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $riu_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $riu_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);


    $is_validation_ok = $riu_controller->validator->validate();

    $json_errors_array = $riu_controller->validator->get_json_errors_array();


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
        $is_update_ok = $riu_controller->update($sanitized_vars);

        //
        if ($is_update_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


//    // This is to let the user see the errors on their forms.
//    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}

if (isset($_GET["read"]) && $_GET["read"] == "yes") {

    // Instance
    $riu_controller = new RateableItemUserController();

    // Do this for GET requests.
    $riu_controller->validator->set_request_type("get");


    /* Initialize Vars */
    $allowed_assoc_indexes = array("rateable_item_ids", "to_read");

    $required_vars_length_array = array(
        "to_read" => ["min" => 9, "max" => 16]
    );

    $riu_controller->validator->items_to_be_length_validated_limits = array(
        "min" => 1,
        "max" => 12
    );

    $riu_controller->validator->items_to_be_length_validated = explode(",",$_GET["rateable_item_ids"]);
    $riu_controller->validator->values_to_be_number_uniformly_checked = explode(",",$_GET["rateable_item_ids"]);




    $riu_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $riu_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $riu_controller->validator->extra_validate();

    $json_errors_array = $riu_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }


        // Let the controller handle it.
        $objs = $riu_controller->read($sanitized_vars);
        $json_errors_array['is_result_ok'] = true;
        $json_errors_array['objs'] = $objs;

    }


//    // This is to let the user see the errors on their forms.
//    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}


?>
