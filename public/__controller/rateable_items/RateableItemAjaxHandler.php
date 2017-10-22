<?php
namespace App\Publico\Controller\RateableItems;

require_once("RateableItemController.php");

//ish

use App\Publico\Controller\RateableItems\RateableItemController;

?>

<?php
if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("item_x_id", "item_x_type_id");
    $required_vars_length_array = array(
        "item_x_id" => ["min" => 1, "max" => 12],
        "item_x_type_id" => ["min" => 1, "max" => 3]

    );

    $vars_to_be_number_uniformly_checked = array("item_x_id", "item_x_type_id");


    //
    $ri_controller = new RateableItemController();

    $ri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $ri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $ri_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);


    $is_validation_ok = $ri_controller->validator->validate();

    $json_errors_array = $ri_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $ri_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            //
//            item_x_id
            $json_errors_array["item_x_id"] = $sanitized_vars["item_x_id"];

            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


//    // This is to let the user see the errors on their forms.
//    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {


    // Instance
    $ri_controller = new RateableItemController();

    // Do this for GET requests.
    $ri_controller->validator->set_request_type("get");

    // Set parameters.
    $allowed_assoc_indexes = array(
        "post_ids",
        "item_x_type_id"
    );

    $required_vars_length_array = array(
        "item_x_type_id" => ["min" => 1, "max" => 3]
    );

    $vars_to_be_number_uniformly_checked = array("item_x_type_id");



    $ri_controller->validator->items_to_be_length_validated_limits = array(
        "min" => 1,
        "max" => 12
    );

    $ri_controller->validator->items_to_be_length_validated = explode(",",$_GET["post_ids"]);
    $ri_controller->validator->values_to_be_number_uniformly_checked = explode(",",$_GET["post_ids"]);


    // Validate
    $ri_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $ri_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $ri_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);




    $is_validation_ok = $ri_controller->validator->extra_validate();
    $json_errors_array = $ri_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }


//        global $session;
//        $json_errors_array['is_viewing_own_account'] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array['rateable_items'] = $ri_controller->read_rateable_item_ids($sanitized_vars);
//ish

        // Should reading of the objs here always be ok?
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}
?>
