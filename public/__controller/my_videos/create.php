<?php
if (isset($_POST["create_video"])) {
    echo "PHP AJAX return: create_video is OK!";
    return;
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON add video clicked.");


    // Validattion.
    validate_video_form();


    // If the code goes here, that means the validation passed.
    add_new_video_record_to_db();

}
?>