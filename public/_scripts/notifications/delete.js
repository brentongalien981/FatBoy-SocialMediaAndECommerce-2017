function get_delete_notification_link(notification) {
    var n = notification;
    var msg = "";
    msg += "<a";
    msg += " id='delete_notification_link" + n['notification_id'] + "'";
    msg += " href='#'";
    msg += " class='delete_friend_notification_links'";
    msg += ">";

    msg += "x";
    msg += "</a>";

    return msg;
}


function delete_x_notification_obj(class_name, notification_id) {
    var crud_type = "delete";
    var request_type = "POST";
    var key_value_pairs = {
        delete : "yes",
        notification_id : notification_id
    };


    var x_notification_obj = null;

    switch(class_name) {
        case "NotificationFriendship":
            x_notification_obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
            break;
        case "NotificationMyShopping":
            x_notification_obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
            break;
    }


    x_notification_obj.delete();

}


function add_listener_to_delete_notification_link(notification, class_name) {
    var n = notification;
    var delete_notification_link = document.getElementById("delete_notification_link" + n['notification_id']);

    delete_notification_link.addEventListener("click", function () {
        // window.alert("EVENT: click for delete button: " + delete_notification_link.id);
        // window.alert("DEBUG:VAR:class_name: " + class_name, n['notification_id']);
        delete_x_notification_obj(class_name, n['notification_id']);
    });
}