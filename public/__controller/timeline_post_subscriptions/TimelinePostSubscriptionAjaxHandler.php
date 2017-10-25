<?php
namespace App\Publico\Controller\TimelinePostSubscriptions;

require_once("TimelinePostSubscriptionController.php");

use App\Publico\Controller\TimelinePostSubscriptions\TimelinePostSubscriptionController;
use App\Publico\Model\TimelinePostSubscription;


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("timeline_post_id");
    $required_vars_length_array = array(
        "timeline_post_id" => ["min" => 1, "max" => 11]

    );

    //
    $tps_controller = new TimelinePostSubscriptionController();

    $tps_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $tps_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $is_validation_ok = $tps_controller->validator->validate();

    $json_errors_array = $tps_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $tps_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array["is_result_ok"] = true;
        }
    }


    echo json_encode($json_errors_array);
}

?>