<?php
namespace App\Publico\Controller\AppSettings;

require_once("AppSettingController.php");

use App\Publico\Controller\AppSettings\AppSettingController;
use App\Publico\Model\AppSetting;

//use App\Publico\Model\AppSetting;

?>


<?php
if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("notifications_is_maximized");
    $required_vars_length_array = array(
        "notifications_is_maximized" => ["min" => 4, "max" => 5]

    );

    //
    $as_controller = new AppSettingController();

    $as_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $as_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $is_validation_ok = $as_controller->validator->validate();

    $json_errors_array = $as_controller->validator->get_json_errors_array();


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
        $is_update_ok = $as_controller->update($sanitized_vars);

        //
        if ($is_update_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {

    $json_errors_array = array();

    // Let the controller handle it.
    $possible_read_objs = AppSettingController::read();
    if ($possible_read_objs != false) {
        $json_errors_array['objs'] = $possible_read_objs;

        // Should reading of the photos here always be ok?
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}
?>


