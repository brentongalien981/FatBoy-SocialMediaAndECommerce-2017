<?php
namespace App\Publico\Controller\AdminTools\UserManagement;

require_once("UserController.php");

use App\Publico\Controller\AdminTools\UserManagement\UserController;
?>





<?php
if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => false));
//    return;



    // Instance
    $user_controller = new UserController();


    // Validate
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);
    // Do this for GET requests.
    $user_controller->validator->set_request_type("get");
    $user_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $user_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $user_controller->validator->validate();
    $json_errors_array = $user_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['users'] = $user_controller->read($sanitized_vars);


        // If everything is ok.
        if (isset($json_errors_array['users']) &&
            $json_errors_array['users'] != null &&
            count($json_errors_array['users']) > 0)
        {

            $json_errors_array['is_result_ok'] = true;

        }
    }


    //
    echo json_encode($json_errors_array);
}
?>
