<?php

use App\Privado\HelperClasses\Validation\Validator;


// TODO:REMINDER: Validate the format of the embed code on the next iteration.

// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["create_follow_acceptance_notification"]) && $_POST["create_follow_acceptance_notification"] == "yes") {

    //
    echo json_encode(array("is_result_ok" => false, "create_follow_acceptance_notification" => $_POST["create_follow_acceptance_notification"]));
    return;
}
?>