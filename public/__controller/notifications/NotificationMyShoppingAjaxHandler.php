<?php
namespace App\Publico\Controller\Notifications;

require_once("NotificationMyShoppingController.php");

use App\Publico\Controller\Notifications\NotificationMyShoppingController;
?>





<?php
if (isset($_GET['update']) && $_GET['update'] == "yes") {
//    // TODO:DEBUG
//    echo json_encode(array("is_result_ok" => false));
//    return;


    /* Validate */
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);


    // Instance
    $n_mshopping_controller = new NotificationMyShoppingController();



    // Do this for GET requests.
    $n_mshopping_controller->validator->set_request_type("get");
    $n_mshopping_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_mshopping_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_mshopping_controller->validator->validate();
    $json_errors_array = $n_mshopping_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $n_mshopping_controller->update_fetch($sanitized_vars);


        // If everything is ok.
        if (isset($json_errors_array['notifications']) &&
            $json_errors_array['notifications'] != null &&
            count($json_errors_array['notifications']) > 0)
        {

            $json_errors_array['is_result_ok'] = true;

        }
    }


    // AJAX return.
    echo json_encode($json_errors_array);
}



if (is_request_post() && isset($_POST["delete"]) && $_POST["delete"] == "yes") {
//    // TODO:DEBUG
//    echo json_encode(array("is_result_ok" => false));
//    return;

    /* Validate */
    $allowed_assoc_indexes = array("notification_id");
    $required_vars_length_array = array(
        "notification_id" => ["min" => 1, "max" => 13]
    );

    $n_mshopping_controller = new NotificationMyShoppingController();

    $n_mshopping_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_mshopping_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_mshopping_controller->validator->validate();
    $json_errors_array = $n_mshopping_controller->validator->get_json_errors_array();


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
        $is_deletion_ok = $n_mshopping_controller->delete($sanitized_vars);

        //
        $json_errors_array['record_affected'] = $is_deletion_ok;

        //
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}



if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => true));
//    return;
    // Instance
    $n_mshopping_controller = new NotificationMyShoppingController();


    // Validate
    $allowed_assoc_indexes = array("offset");
    $required_vars_length_array = array("offset" => ["min" => 1, "max" => 3]);
    // Do this for GET requests.
    $n_mshopping_controller->validator->set_request_type("get");
    $n_mshopping_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $n_mshopping_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $n_mshopping_controller->validator->validate();
    $json_errors_array = $n_mshopping_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $n_mshopping_controller->read($sanitized_vars);


//        // If everything is ok.
//        if (isset($json_errors_array['notifications']) &&
//            $json_errors_array['notifications'] != null &&
//            count($json_errors_array['notifications']) > 0)
//        {

            $json_errors_array['is_result_ok'] = true;

//        }
    }


    //
    echo json_encode($json_errors_array);
}

if (isset($_GET['fetch']) && $_GET['fetch'] == "yes") {
    // Instance
    $nms_controller = new NotificationMyShoppingController();


    // Validate
    $allowed_assoc_indexes = array("latest_notification_date");
    $required_vars_length_array = array("latest_notification_date" => ["min" => 19, "max" => 20]);
    // Do this for GET requests.
    $nms_controller->validator->set_request_type("get");
    $nms_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nms_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nms_controller->validator->validate();
    $json_errors_array = $nms_controller->validator->get_json_errors_array();


    if ($is_validation_ok) {
        // Prepare the necessary data to pass to the controller.
        // Sanitized vars for passing to the controller.
        $sanitized_vars = array();
        foreach ($allowed_assoc_indexes as $index) {
            \MyDebugMessenger::add_debug_message("GET VAR: {$_GET[$index]}");
            $sanitized_vars[$index] = $_GET[$index];
        }



        // Let the controller handle it.
        $json_errors_array['notifications'] = $nms_controller->fetch($sanitized_vars);


        // If everything is ok.
//        if (isset($json_errors_array['notifications']) &&
//            $json_errors_array['notifications'] != null &&
//            count($json_errors_array['notifications']) > 0)
//        {
//
//            $json_errors_array['is_result_ok'] = true;
//
//        }
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
}

if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array(
        "new_invoice_item_status_id",
        "the_invoice_item_id"
    );

    $required_vars_length_array = array(
        "new_invoice_item_status_id" => ["min" => 1, "max" => 2],
        "the_invoice_item_id" => ["min" => 1, "max" => 12]
    );

    $nms_controller = new NotificationMyShoppingController();

    $nms_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $nms_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
    $is_validation_ok = $nms_controller->validator->validate();
    $json_errors_array = $nms_controller->validator->get_json_errors_array();



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
        $is_creation_ok = $nms_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            $json_errors_array['is_result_ok'] = true;
        }
    }


    //
    echo json_encode($json_errors_array);
}



// This is pretty much the CRUD Create of NotificationMyShopping.
if (is_request_post() && isset($_POST["invoice_item_status_update"]) && $_POST["invoice_item_status_update"] == "yes") {

    //
    $data = array(
        "update_status_id" => $_POST['selected_status_id'],
        "invoice_item_id" => $_POST['invoice_item_id']
    );


    //
    $n_mshopping_controller = new NotificationMyShoppingController();
    $is_creation_ok = $n_mshopping_controller->create($data);



    // TODO:DEBUG
    if ($is_creation_ok) {
        echo json_encode(array("is_result_ok" => true));
    }
    else {
        echo json_encode(array("is_result_ok" => false));
    }
}



//if (is_request_post() && isset($_POST["invoice_item_status_update"]) && $_POST["invoice_item_status_update"] == "yes") {
//
//
//    /* Validate */
//    $allowed_assoc_indexes = array("friend_id", "notification_msg_id");
//    $required_vars_length_array = array(
//        "friend_id" => ["min" => 1, "max" => 11],
//        "notification_msg_id" => ["min" => 1, "max" => 2]
//    );
//
//    $n_friendship_controller = new NotificationFriendshipController();
//
//    $n_friendship_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
//    $n_friendship_controller->validator->set_required_post_vars_length_array($required_vars_length_array);
//    $is_validation_ok = $n_friendship_controller->validator->validate();
//    $json_errors_array = $n_friendship_controller->validator->get_json_errors_array();
//
//
//    //
//    if ($is_validation_ok) {
//        // Everything is ok.
//        $json_errors_array['is_result_ok'] = true;
//
//
//
//
//        // Prepare the necessary data to pass to the controller.
//        // Sanitized vars for passing to the controller.
//        $sanitized_vars = array();
//        foreach ($allowed_assoc_indexes as $index) {
//            \MyDebugMessenger::add_debug_message("POST VAR: {$_POST[$index]}");
//            $sanitized_vars[$index] = $_POST[$index];
//        }
//
//
//
//        // Let the controller handle it.
//        $is_creation_ok = $n_friendship_controller->create($sanitized_vars);
//
//        //
//        if (!$is_creation_ok) {
//            $json_errors_array['is_result_ok'] = false;
//        }
//    }
//
//
//    //
//    echo json_encode($json_errors_array);
//}
?>
