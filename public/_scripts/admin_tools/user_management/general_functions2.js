function clear_user_info_inputs() {
    // DEFAULT
    password.value = "";

    email.value = "";



    user_id.value = "";
    user_name.value = "";
    user_type.value = 1;
    privacy.value = 1;
    account_status.value = 1;
}





function hide_error_msgs() {
    var error_labels = document.getElementsByClassName("error_msg");

    for (i = 0; i < error_labels.length; i++) {
        error_labels[i].style.visibility = "hidden";
    }
}