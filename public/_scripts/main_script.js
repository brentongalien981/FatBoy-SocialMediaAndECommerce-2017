function show_flash_notification(x_obj, json) {
    // TODO:REMINDER: Make the notification more presentable in producation.
    if (json == null || !json.is_result_ok) {
        // FAIL on [crud]ing [x]Notification.
        // window.alert("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
    else {
        // SUCCESS on [crud]ing [x]Notification.
        // window.alert("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
}



function get_subfolder(class_name) {
    //
    var subfolder = "";

    switch (class_name) {
        case "FriendshipSuggestion":
            subfolder = "friends";
            break;
        case "NotificationFriendship":
            subfolder = "notifications";
            break;
        case "yYy":
            break;
        case "zZz":
            break;
    }


    return subfolder;
}