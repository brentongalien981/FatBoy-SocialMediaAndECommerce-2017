<?php
namespace App\Publico\Controller\AdminTools\UserManagement;

require_once("UserController.php");

use App\Publico\Controller\AdminTools\UserManagement\UserController;
?>





<?php
if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => false));
//    return;
    // TODO:REMINDER: Remove this later.
    sleep(1);



    // Instance
    $user_controller = new UserController();


    // Validate
    $allowed_assoc_indexes = array("offset");
    $required_vars_length_array = array("offset" => ["min" => 1, "max" => 11]);
    // Do this for GET requests.
    $user_controller->validator->set_request_type("get");
    $user_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $user_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $user_controller->validator->validate();
    $json_errors_array = $user_controller->validator->get_json_errors_array();


    // FLAG
    $json_errors_array['num_of_offset'] = $_GET['offset'];


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


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

//    // TODO:DEBUG
//    echo json_encode(array(
//        "is_result_ok" => true,
//        "putang" => "ina mo",
//        "user_name" => $_POST['user_name'],
//        "password" => $_POST['password'],
//        "email" => $_POST['email'],
//        "user_type" => $_POST['user_type'],
//        "privacy" => $_POST['privacy'],
//        "account_status" => $_POST['account_status']
//
//        ));
//    return;


    /* Validate */
    $allowed_assoc_indexes = array("user_name", "password", "email", "user_type", "privacy", "account_status");
    $required_vars_length_array = array(
        "user_name" => ["min" => 2, "max" => 11],
        "password" => ["min" => 2, "max" => 8],
        "email" => ["min" => 5, "max" => 200]
    );


    // Format is
        // "key" => [
        //      'regex' => '\adsf\', // * Error: contains invalid characters.
        //      'numeric' => 2,      // * Error: should contain at least 2 numeric characters.
        //      'alpha' => 3         // * Error: should contain at least 3 numeric characters.
        // ]
    $vars_to_be_format_checked = array(
        "user_name" => [
            'regex' => '/[^a-zA-Z0-9_\-\.]/',
            'is_regex_negated' => true,
            'numeric' => 1,
            'alpha' => 5
        ],
        "password" => [
            'regex' => '/[^a-zA-Z0-9_\-\.]/',
            'is_regex_negated' => false,
            'numeric' => 1,
            'alpha' => 6
        ]
    );



    $vars_to_be_unique_checked = array(
        "user_name" => [
            'table' => 'Users',
            'column' => 'user_name'
        ],
        "email" => [
            'table' => 'Users',
            'column' => 'email'
        ]
    );


    //uki
    $user_detail_types = array(
        "user_type" => [1, 2, 3, 4, 5],
        "privacy" => [0, 1],
        "account_status" => [1, 2, 3, 4]
    );



    //
    $user_controller = new UserController();

    $user_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $user_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $user_controller->validator->set_user_detail_types($user_detail_types);
    $user_controller->validator->set_formats($vars_to_be_format_checked);
    $user_controller->validator->validate_email = true;
    $user_controller->validator->set_unique_vars($vars_to_be_unique_checked);

    $is_validation_ok = $user_controller->validator->validate();
    $json_errors_array = $user_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $user_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}
?>
