<?php

use App\Privado\HelperClasses\Validation\Validator;






// Protected page.
//global $session;
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}






// TODO:REMINDER: Validate the format of the embed code on the next iteration.

// TODO:SECTION: AJAX Event-handler.
if (is_request_post() && isset($_POST["create_video"]) && $_POST["create_video"] == "yes") {
    //
    $allowed_assoc_indexes_for_post = array("title", "embed_code");

    $validator = get_validator_obj($allowed_assoc_indexes_for_post);

    $is_validation_ok = $validator->validate();


    //
    $json_errors_array = $validator->get_json_errors_array();

    // Try to add record to db.
    if ($is_validation_ok &&
            create_record($allowed_assoc_indexes_for_post)) {

        // Everything is ok.
        $json_errors_array['is_result_ok'] = true;
    }


    //
    echo json_encode($json_errors_array);
    return;
}
?>





<?php

function get_validator_obj(&$allowed_assoc_indexes_for_post) {
    //
    $required_post_vars_length_array = array("title" => ["min" => 2, "max" => 100],
        "embed_code" => ["min" => 2, "max" => 1000]);

//
    $validator = new Validator();
    $validator->set_allowed_post_vars($allowed_assoc_indexes_for_post);
    $validator->set_required_post_vars_length_array($required_post_vars_length_array);

    return $validator;
}

function create_record($allowed_assoc_indexes_for_post) {

    // Set the "user-dependent" attributes of the new video.
    $new_video = new MyVideo();
    $new_video->id = null;
    global $session;
    $new_video->user_id = $session->actual_user_id;
    $default_rating = 7;
    $new_video->rating = $default_rating;


    // Set the "dynamic" attributes of the new video.
    foreach ($allowed_assoc_indexes_for_post as $index) {
        $new_video->$index = $_POST[$index];
    }



    //
    $creation_result = $new_video->create_with_bool();


    return $creation_result;
}
?>