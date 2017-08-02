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





function clear_container(container) {
    console.log("*****************************");
    console.log("VAR:container.childNodes.length: " + container.childNodes.length);
    console.log("*****************************");

    var actual_childnodes_length = container.childNodes.length - 3;

    for (i = 0; i < actual_childnodes_length; i++) {
        // Because this will count the <th>s of the <thead> as indexes
        // 0, 1, and 2.
        // You don't want that, so the actual starting index is 3.
        // And you always wanna remove the element[3], cause it's like
        // a stack...
        container.removeChild(container.childNodes[3]);
    }
}