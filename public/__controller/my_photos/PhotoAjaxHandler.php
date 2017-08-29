<?php
namespace App\Publico\Controller\MyPhotos;

require_once("PhotoController.php");

use App\Publico\Controller\MyPhotos\PhotoController;

?>


<?php
if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $photo_controller = new PhotoController();


    // Validate
    $allowed_assoc_indexes = array(
        "offset"
    );

    $required_vars_length_array = array(
        "offset" => ["min" => 1, "max" => 7]
    );


    // Do this for GET requests.
    $photo_controller->validator->set_request_type("get");


    //
    $photo_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $photo_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $photo_controller->validator->validate();
    $json_errors_array = $photo_controller->validator->get_json_errors_array();


//    // FLAG
//    $json_errors_array['num_of_offset'] = $_GET['offset'];


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }


        // Let the controller handle it.
        $json_errors_array['photos'] = $photo_controller->read($sanitized_vars);


        // Should reading of the photos here always be ok?
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}


if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

//    // TODO:DEBUG
//    echo json_encode(array(
//        "is_result_ok" => true,
//        "photo_title" => $_POST['photo_title'],
//        "href" => $_POST['href'],
//        "src" => $_POST['src'],
//        "width" => $_POST['width'],
//        "height" => $_POST['height']
//        ));
//    return;


    /* Validate */
    $allowed_assoc_indexes = array("photo_title", "href", "src", "width", "height");
    $required_vars_length_array = array(
        "photo_title" => ["min" => 5, "max" => 256],
        "href" => ["min" => 32, "max" => 1024],
        "src" => ["min" => 32, "max" => 1024],
        "width" => ["min" => 2, "max" => 4],
        "height" => ["min" => 2, "max" => 4]

    );

    $vars_to_be_number_uniformly_checked = array("width", "height");

    $vars_to_be_prefix_checked = array("href", "src");


    // Format is
    // "key" => [
    //      'regex' => '\adsf\', // * Error: contains invalid characters.
    //      'numeric' => 2,      // * Error: should contain at least 2 numeric characters.
    //      'alpha' => 3         // * Error: should contain at least 3 numeric characters.
    // ]
//    $vars_to_be_format_checked = array(
//        "user_name" => [
//            'regex' => '/[^a-zA-Z0-9_\-\.]/',
//            'is_regex_negated' => true,
//            'numeric' => 1,
//            'alpha' => 5
//        ],
//        "password" => [
//            'regex' => '/[^a-zA-Z0-9_\-\.]/',
//            'is_regex_negated' => false,
//            'numeric' => 1,
//            'alpha' => 6
//        ]
//    );


//    $vars_to_be_unique_checked = array(
//        "user_name" => [
//            'table' => 'Users',
//            'column' => 'user_name'
//        ]
////        "email" => [
////            'table' => 'Users',
////            'column' => 'email'
////        ]
//    );


    //
    $photo_controller = new PhotoController();

    $photo_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $photo_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

//    $photo_controller->validator->set_formats($vars_to_be_format_checked);
//    $photo_controller->validator->validate_email = true;
//    $photo_controller->validator->set_unique_vars($vars_to_be_unique_checked);
    $photo_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);
    $photo_controller->validator->set_vars_to_be_prefix_checked($vars_to_be_prefix_checked);

    $is_validation_ok = $photo_controller->validator->validate();

    $json_errors_array = $photo_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $photo_controller->create($sanitized_vars);

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

if (is_request_post() && isset($_POST["update"]) && $_POST["update"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("edit_photo_id", "edit_photo_title", "edit_href", "edit_src", "edit_width", "edit_height");
    $required_vars_length_array = array(
        "edit_photo_id" => ["min" => 1, "max" => 12],
        "edit_photo_title" => ["min" => 5, "max" => 256],
        "edit_href" => ["min" => 32, "max" => 1024],
        "edit_src" => ["min" => 32, "max" => 1024],
        "edit_width" => ["min" => 2, "max" => 4],
        "edit_height" => ["min" => 2, "max" => 4]
    );

    $vars_to_be_number_uniformly_checked = array("edit_width", "edit_height");
    $vars_to_be_prefix_checked = array("edit_href", "edit_src");


    //
    $photo_controller = new PhotoController();

    $photo_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $photo_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $photo_controller->validator->set_vars_to_be_number_uniformly_checked($vars_to_be_number_uniformly_checked);
    $photo_controller->validator->set_vars_to_be_prefix_checked($vars_to_be_prefix_checked);

    $is_validation_ok = $photo_controller->validator->validate();
    $json_errors_array = $photo_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }


        //ish
        // Let the controller handle it.
        $is_update_ok = $photo_controller->update($sanitized_vars);

        //
        if ($is_update_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("photo_id");
    $required_vars_length_array = array(
        "photo_id" => ["min" => 1, "max" => 12]
    );


    //
    $photo_controller = new PhotoController();

    $photo_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $photo_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $photo_controller->validator->validate();
    $json_errors_array = $photo_controller->validator->get_json_errors_array();


    //
    if ($is_validation_ok) {

        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
            $sanitized_vars[$index] = $_POST[$index];
        }


        //ish
        // Let the controller handle it.
        $is_deletion_ok = $photo_controller->delete($sanitized_vars);

        //
        if ($is_deletion_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    // This is to let the user see the errors on their forms.
//    $json_errors_array['form_errors_showable'] = true;
    echo json_encode($json_errors_array);
}
?>
