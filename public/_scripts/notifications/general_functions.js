function my_sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}





/**
 *
 * @param new_container_id
 * @return {Node}
 */
function clone_categorized_notification_template(new_container_id) {
    //
    var container = categorized_notification_container_template.cloneNode(true);

    // Append
    main_content.appendChild(container);

    // Change the id.
    container.id = new_container_id;

    //
    return container;

}


function populate_x_notification_container(container, notifications, class_name, crud_type) {
    console.log("PUTA: notifications.length: " + notifications.length);

    for (var i = 0; i < notifications.length; i++) {
        var notification = notifications[i];
        console.log("PUTA: notification[notification_msg_id]: " + notification['notification_msg_id']);
        var prepared_notification = get_prepared_notification(class_name, notification);

        append_a_notification(container, prepared_notification);

        // uki
        add_listener_to_delete_notification_link(notification, class_name);





        // If the notification is a follow request,
        // add listener to the "accept" link.
        if (notification['notification_msg_id'] == 2) {
            add_listener_to_accept_follow_request_link(notification);
        }
    }

    //
    if (crud_type === "read") {
        prepare_update(class_name);
    }


    //uki3
    show_x_container(container);


    //
    if (container.childNodes.length <= 0) { hide_x_container(container); }

    console.log("*************************")
    console.log("DEBUG:VAR:container.childNodes.length: " + container.childNodes.length);
    console.log("DEBUG:VAR:container.id: " + container.id);
    console.log("DEBUG:VAR:crud_type: " + crud_type);
    console.log("*************************")

}



function prepare_update(class_name) {
    switch (class_name) {
        case "NotificationFriendship":
            can_friendship_notifications_update = true;
            break;
        case "NotificationMyShopping":
            can_my_shopping_notifications_update = true;
            break;
        case "zZz":
            break;
    }
}


function get_prepared_notification(class_name, notification) {
    var notification_msg_id = notification['notification_msg_id'];
    // var prepared_notification = "<p class='notifications'>";
    var prepared_notification = document.createElement("p");
    prepared_notification.classList.add("notifications");
    prepared_notification.id = "notification" + notification['notification_id'];

    var content = "";

    console.log("DEBUG:VAR:notification_msg_id: " + notification_msg_id);


    //uki2
    content += get_delete_notification_link(class_name, notification);



    //
    switch (notification_msg_id) {
        case "1": // Invoice item (bought product) status update.
            content += get_notification_for_invoice_item_status_update(notification);
            break;
        case "2": // Follow acceptance...
            content += get_notification_for_follow_request(notification);
            break;
        case "3": // Follow request...
            content += get_notification_for_follow_acceptance(notification);
            break;
    }

    // prepared_notification += '</p>';
    prepared_notification.innerHTML = content;


    return prepared_notification;
}


function append_a_notification(container, prepared_notification) {
    container.appendChild(prepared_notification);
    // container.innerHTML += prepared_notification;
    // console.log("INNERHTML: " + prepared_notification);
}
