<?php
namespace App\Publico\Controller\ChatList;

require_once("ChatListController.php");

//use App\Publico\Controller\MyPhotos\ChatListController;

?>

<?php
if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // Instance
    $cl_controller = new ChatListController();


    // Validate
    $allowed_assoc_indexes = array(
        "offset"
    );

    $required_vars_length_array = array(
        "offset" => ["min" => 1, "max" => 10]
    );


    // Do this for GET requests.
    $cl_controller->validator->set_request_type("get");


    //
    $cl_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $cl_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $cl_controller->validator->validate();
    $json_errors_array = $cl_controller->validator->get_json_errors_array();


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

        //
        global $session;
//        $json_errors_array['is_viewing_own_account'] = $session->is_viewing_own_account();

        // Let the controller handle it.
        $json_errors_array['objs'] = $cl_controller->read($sanitized_vars);


        // Should reading of the objs here always be ok?
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["manage_thread"]) && $_POST["manage_thread"] == "yes") {

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
    $allowed_assoc_indexes = array("user_id");
    $required_vars_length_array = array(
        "user_id" => ["min" => 1, "max" => 11]

    );


    //
    $cl_controller = new ChatListController();

    $cl_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $cl_controller->validator->set_required_post_vars_length_array($required_vars_length_array);


    $is_validation_ok = $cl_controller->validator->validate();

    $json_errors_array = $cl_controller->validator->get_json_errors_array();


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
        $is_result_ok = $cl_controller->manage_thread($sanitized_vars);

        $json_errors_array['is_result_ok'] = $is_result_ok;
    }

    echo json_encode($json_errors_array);
}
?>
