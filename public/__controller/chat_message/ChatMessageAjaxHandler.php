<?php
namespace App\Publico\Controller\ChatMessage;

require_once("ChatMessageController.php");

use App\Publico\Controller\ChatMessage\ChatMessageController;

?>


<?php
if (is_request_post() && isset($_POST["create"]) && $_POST["create"] == "yes") {

    /* Validate */
    $allowed_assoc_indexes = array("message");
    $required_vars_length_array = array(
        "message" => ["min" => 1, "max" => 1000]

    );

    //
    $cm_controller = new ChatMessageController();

    $cm_controller->validator->set_allowed_post_vars($allowed_assoc_indexes);
    $cm_controller->validator->set_required_post_vars_length_array($required_vars_length_array);

    $is_validation_ok = $cm_controller->validator->validate();

    $json_errors_array = $cm_controller->validator->get_json_errors_array();


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
        $is_creation_ok = $cm_controller->create($sanitized_vars);

        //
        if ($is_creation_ok) {
            // Everything is ok.
            $json_errors_array['is_result_ok'] = true;
        }
    }


    echo json_encode($json_errors_array);
}

if (isset($_GET['read']) && $_GET['read'] == "yes") {

    // No need for validation here.
    
    // Instance
    global $session;
    $cm_controller = new ChatMessageController();

    // Let the controller handle it.
    $json_errors_array['objs'] = $cm_controller->read();


    // Should reading of the photos here always be ok?
    $json_errors_array['is_result_ok'] = true;

    $json_errors_array['actual_user_id'] = $session->actual_user_id;

    //
    echo json_encode($json_errors_array);
}
?>
