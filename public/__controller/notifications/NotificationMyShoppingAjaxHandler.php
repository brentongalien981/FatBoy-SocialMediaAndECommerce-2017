<?php
namespace App\Publico\Controller\Notifications;

require_once("NotificationMyShoppingController.php");

use App\Publico\Controller\Notifications\NotificationMyShoppingController;
?>





<?php
if (isset($_GET['read']) && $_GET['read'] == "yes") {
//    echo json_encode(array("is_result_ok" => true));
//    return;
    // Instance
    $n_mshopping_controller = new NotificationMyShoppingController();


    // Validate
    $allowed_assoc_indexes = array("section");
    $required_vars_length_array = array("section" => ["min" => 1, "max" => 3]);
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


        // If everything is ok.
        if (isset($json_errors_array['notifications']) &&
            $json_errors_array['notifications'] != null &&
            count($json_errors_array['notifications']) > 0)
        {

            $json_errors_array['is_result_ok'] = true;

        }
    }


    //
    echo json_encode($json_errors_array);
}




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
