<?php
namespace App\Publico\Controller\Profile;

require_once("ProfileController.php");

use App\Publico\Controller\Profile\ProfileController;


if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $profile_controller = new ProfileController();


    // Validate
    $allowed_assoc_indexes = array(
        "shit"
    );

    $required_vars_length_array = array(
        "shit" => ["min" => 1, "max" => 4]
    );


    // Do this for GET requests.
    $profile_controller->validator->set_request_type("get");


    //
    $profile_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $profile_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $profile_controller->validator->validate();
    $json_errors_array = $profile_controller->validator->get_json_errors_array();



    /**/
    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }

        // Let the controller handle it.
        $json_errors_array["objs"] = $profile_controller->read($sanitized_vars);


        /**/
        if (isset($json_errors_array["objs"])) {
            $json_errors_array["is_result_ok"] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}

?>