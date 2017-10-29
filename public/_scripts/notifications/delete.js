function dom_remove_notification(caller_class_name, notification_id) {
    console.log("In METHOD: dom_remove_notification().");
    console.log("In METHOD:VAR:caller_class_name: " + caller_class_name);
    console.log("In METHOD:VAR:notification_id: " + notification_id);

    // x_notification_container id.
    var id = caller_class_name + "ActualContainer";

    // x_notification_container.
    var container = document.getElementById(id);

    // notification <p>
    var notification = document.getElementById("notification" + notification_id);


    animate_node_removal(container, notification, caller_class_name);

}


function animate_node_removal(container, node, caller_class_name) {
    global_notification_counter = 10;
    global_notification_timer_handler = setInterval(function () {


        node.style.opacity = "" + (global_notification_counter * .1) + "";
        // console.log("DEBUG:global_notification_counter * .1: " + (global_notification_counter * .1))

        --global_notification_counter;

        if (global_notification_counter <= 0) {
            //
            container.removeChild(node);


            //
            clearInterval(global_notification_timer_handler);
        }
    }, 35);
}


function get_delete_notification_link(class_name, notification) {
    var n = notification;
    var msg = "";
    msg += "<a";
    msg += " id='delete_notification_link" + n['notification_id'] + "'";
    // msg += " href=''";

    msg += " class=' delete_notification_links";

    if (class_name == "NotificationFrienship") {
        msg += " delete_friend_notification_links";
    }
    else if (class_name == "NotificationMyShopping") {
        msg += " delete_my_shopping_notification_links";
    }

    msg += "'>";

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
        case "NotificationRateableItem":
            x_notification_obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
            break;
        case "NotificationTimelinePostReply":
            x_notification_obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
            break;
    }


    x_notification_obj.delete();

}


function add_listener_to_delete_notification_link(notification, class_name) {
    // if (class_name == "NotificationRateableItem") {
    //     // window.alert("TODO: Add listener to delete-link of the rateable-item-notificationos.");
    //     return;
    // }

    var n = notification;
    var delete_notification_link = document.getElementById("delete_notification_link" + n['notification_id']);

    delete_notification_link.addEventListener("click", function () {
        // window.alert("EVENT: click for delete button: " + delete_notification_link.id);
        // window.alert("DEBUG:VAR:class_name: " + class_name, n['notification_id']);
        delete_x_notification_obj(class_name, n['notification_id']);
    });
}