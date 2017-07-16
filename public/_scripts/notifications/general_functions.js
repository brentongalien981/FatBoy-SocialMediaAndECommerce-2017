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
        var prepared_notification = get_prepared_notification(notification);

        append_a_notification(container, prepared_notification);

        //
        add_listener_to_delete_notification_link(notification, class_name);

        // TODO
        add_listener_to_accept_follow_request_link(notification);
    }

    //
    if (crud_type === "read" &&
        notifications.length > 0)
    {
        // TODO:DEBUG
        console.log("*********** ++++++ *********");
        console.log("In METHOD: populate_container()");
        console.log("crud_type === read");
        console.log("notifications.length > 0");

        //
        show_x_container(container);

        // Start the updates.
        console.log("VAR-BEFORE:can_friendship_notifications_update: " + can_friendship_notifications_update);
        can_friendship_notifications_update = true;
        console.log("VAR-AFTER:can_friendship_notifications_update: " + can_friendship_notifications_update);
    }

}


function get_prepared_notification(notification) {
    var notification_msg_id = notification['notification_msg_id'];
    // var prepared_notification = "<p class='notifications'>";
    var prepared_notification = document.createElement("p");
    prepared_notification.classList.add("notifications");
    prepared_notification.id = "notification" + notification['notification_id'];

    var content = "";

    console.log("DEBUG:VAR:notification_msg_id: " + notification_msg_id);


    //
    content += get_delete_notification_link(notification);



    //
    switch (notification_msg_id) {
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
