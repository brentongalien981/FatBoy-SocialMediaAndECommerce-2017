// function my_sleep(ms) {
//     return new Promise(resolve => setTimeout(resolve, ms));
// }


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

function populate_x_notification_container2(container, notifications, class_name, crud_type) {
    
    for (var i = 0; i < notifications.length; i++) {
        var notification = notifications[i];
        var prepared_notification = get_prepared_notification(class_name, notification);

        //
        if (crud_type == "fetch") {
            squeeze_first_a_notification(container, prepared_notification);
        }
        else {
            append_a_notification(container, prepared_notification);
        }


        // TODO: Add listener to delete-link of the post notificationos.
        add_listener_to_delete_notification_link(notification, class_name);
        add_other_listeners(notification);

    }

    //
    if (crud_type === "read") {
        // Prepare the AJAX for update.
        prepare_update(class_name);
    }


    //
    show_x_container2(class_name);


    // If the x_container doesn't have any notifications to display..
    set_container_display_visibility(class_name);


}

function add_other_listeners(notification) {
    var n = notification;

    switch (n["notification_msg_id"]) {
        case "2":
            add_listener_to_accept_follow_request_link(notification);
            break;
        case "":
            break;
    }
}

function set_container_display_visibility(class_name) {
    var actual_class_name = "";
    switch (class_name) {
        case "NotificationMyShopping":
            actual_class_name = ".my_shopping_notifications";
            break;
        case "NotificationRateableItem":
            actual_class_name = ".rateable_item_notifications";
            break;
        case "NotificationFriendship":
            actual_class_name = ".friendship_notifications";
            break;
        case "NotificationTimelinePostReply":
            actual_class_name = ".timeline_post_reply_notifications";
            break;
    }

    if ($(actual_class_name).length <= 0) {
        hide_x_container2(class_name);
    }
}

// // @deprecated
// function populate_x_notification_container(container, notifications, class_name, crud_type) {
//     // console.log("PUTA: notifications.length: " + notifications.length);
//
//     for (var i = 0; i < notifications.length; i++) {
//         var notification = notifications[i];
//         // console.log("PUTA: notification[notification_msg_id]: " + notification['notification_msg_id']);
//         var prepared_notification = get_prepared_notification(class_name, notification);
//
//         //
//         append_a_notification(container, prepared_notification);
//
//         //
//         add_listener_to_delete_notification_link(notification, class_name);
//
//
//         // If the notification is a follow request,
//         // add listener to the "accept" link.
//         if (notification['notification_msg_id'] == 2) {
//             add_listener_to_accept_follow_request_link(notification);
//         }
//     }
//
//     //
//     if (crud_type === "read") {
//         // Prepare the AJAX for update.
//         prepare_update(class_name);
//     }
//
//
//     //
//     // show_x_container(container);
//     show_x_container2(class_name);
//
//
//     // If the x_container doesn't have any notifications to display..
//     // NOTE: I don't know why it's 5 when it only has <h4> and <hr> as
//     //       default children.
//     // window.alert("container.childNodes.length: " + container.childNodes.length);
//     if (container.childNodes.length <= 5) {
//         // hide_x_container(container);
//     }
//
//     // console.log("*************************")
//     // console.log("DEBUG:VAR:container.childNodes.length: " + container.childNodes.length);
//     // console.log("DEBUG:VAR:container.id: " + container.id);
//     // console.log("DEBUG:VAR:crud_type: " + crud_type);
//     // console.log("*************************")
//
// }


/**
 * @note change the method name to prepare_fetch().
 * @param class_name
 */
function prepare_update(class_name) {
    switch (class_name) {
        case "NotificationFriendship":
            can_friendship_notifications_fetch = true;
            break;
        case "NotificationMyShopping":
            can_my_shopping_notifications_fetch = true;
            break;
        case "NotificationRateableItem":
            can_rateable_item_notifications_fetch = true;
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

    prepared_notification.setAttribute("date-updated", notification["date_updated"]);

    var content = "";

    console.log("DEBUG:VAR:notification_msg_id: " + notification_msg_id);


    //
    content += get_delete_notification_link(class_name, notification);


    //
    switch (notification_msg_id) {
        case "1": // Invoice item (bought product) status update.
            prepared_notification.classList.add("my_shopping_notifications");

            content += get_notification_for_invoice_item_status_update(notification);

            // Also, if it's a my_shopping notification, add an attribute invoice_item_id
            // to the notification's <p> element, so that I can delete a notification
            // that is currently displayed that has older status date and replace it
            // with a new notification that has newer status date. And it should be
            // a replacement for the notification that has the same invoice_item_id.
            prepared_notification.setAttribute("invoice_item_id", notification['invoice_item_id']);

            prepared_notification.setAttribute("status_name", notification['status_name']);
            break;
        case "2": // Follow acceptance...
            prepared_notification.classList.add("friendship_notifications");
            content += get_notification_for_follow_request(notification);
            break;
        case "3": // Follow request...
            prepared_notification.classList.add("friendship_notifications");
            content += get_notification_for_follow_acceptance(notification);
            break;
        case "4": // Post has been tag-rated...
            prepared_notification.classList.add("rateable_item_notifications");
            content += get_content_for_rateable_item_notification(notification);
            break;
        case "5": // There's a new comment for a post
            prepared_notification.classList.add("timeline_post_reply_notifications");
            content += get_content_for_timeline_post_reply_notification(notification);
            break;
    }

    // prepared_notification += '</p>';
    prepared_notification.innerHTML = content;


    return prepared_notification;
}

function prepare_notification_x_container(class_name) {
    var id = class_name + "Container";
    var container = document.getElementById(id);
    // main_content.appendChild(container);
    notifications_widget_main_container.appendChild(container);
}



function get_actual_notification_x_container(class_name) {
    var id = class_name + "ActualContainer";
    var actual_container = document.getElementById(id);
    return actual_container;
}


function append_a_notification(container, prepared_notification) {
    container.appendChild(prepared_notification);
    // container.innerHTML += prepared_notification;
    // console.log("INNERHTML: " + prepared_notification);
}

function squeeze_first_a_notification(container, prepared_notification) {
    // container.appendChild(prepared_notification);
    $(container).prepend($(prepared_notification));

}

function get_num_of_dom_notifications(class_name) {
    var specific_class_name = "";

    switch (class_name) {
        // case "NotificationPost":
        //     specific_class_name = "post_notifications";
        //     break;
        case "NotificationRateableItem":
            specific_class_name = "rateable_item_notifications";
            break;
        case "NotificationMyShopping":
            specific_class_name = "my_shopping_notifications";
            break;
        case "NotificationFriendship":
            specific_class_name = "friendship_notifications";
        case "NotificationTimelinePostReply":
            specific_class_name = "timeline_post_reply_notifications";
            break;
    }

    var length = $("." + specific_class_name).length;

    if (length == null) { length = 0; }

    return length;
}

/**
 *
 * @param notification_class_name
 * @return The currently dom-displayed latest date for that type of notification.
 */
function get_notification_with_latest_date(notification_class_name) {
    var specific_class_name = "";

    switch (notification_class_name) {
        case "NotificationRateableItem":
            specific_class_name = ".rateable_item_notifications";
            break;
        case "NotificationMyShopping":
            specific_class_name = ".my_shopping_notifications";
            break;
        case "NotificationFriendship":
            specific_class_name = ".friendship_notifications";
        case "NotificationTimelinePostReply":
            specific_class_name = ".timeline_post_reply_notifications";
            break;

    }

    var the_latest_notification = $(specific_class_name)[0];
    var latest_date = $(the_latest_notification).attr("date-updated");

    if (the_latest_notification == null ||
        latest_date == null ||
        latest_date == "") {

        return "2010-09-11 10:54:45";
    }
    else {
        return latest_date;
    }
}

function dom_remove_outdated_notifications(notifications) {

    //
    for (var i = 0; i < notifications.length; i++) {
        var old_notification_id = notifications[i]["notification_id"];

        $('#notification' + old_notification_id).remove();
    }
}
