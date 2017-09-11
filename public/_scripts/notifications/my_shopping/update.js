/**
 * Remove a my_shopping notification that could be replaced by a notification
 * that has newer status date (but make sure it is for a notification that has
 * the same invoice_item_id).
 * @param container
 * @param notifications
 * @param class_name
 * @param crud_type
 */
function is_there_replaceable_notification(container, notifications, class_name, crud_type) {
    if (notifications.length <= 0) { return false; }


    var my_shopping_notifications = document.getElementsByClassName("my_shopping_notifications");

    for (i = 0; i < my_shopping_notifications.length; i++) {
        var a_notification = notifications[0];
        var to_be_removed_notification = my_shopping_notifications[i];

        // Yes, there's a notification that has older status date and
        // need to be replaced.
        if ((to_be_removed_notification.getAttribute("invoice_item_id") == a_notification['invoice_item_id']) &&
            (to_be_removed_notification.getAttribute("status_name") != a_notification['status_name'])) {

            // Ex. Remove the prefix "notification" from notification83.
            var notification_id = to_be_removed_notification.id.substring(12);
            // dom_remove_notification(class_name, notification_id);

            delete_x_notification_obj(class_name, notification_id);
            return true;
        }
    }

    return false;
}



function is_there_spot_to_fill(container) {
    // NOTE: The -5 here is the bullshit of html.
    //       Even though by default, my x_notification_containers
    //       only has <h4> and <hr>, the code "el.childNodes.length" gives 5.
    var actual_num_notifications = container.childNodes.length - 5; // The number of noti. in that specific x container.

    // TODO:REMINDER: Make the VAR: section a variable.
    var section = 1;
    var supposed_num_notifications = section * num_notifications_per_section;

    //
    if (actual_num_notifications <  supposed_num_notifications) {
        return true;
    }

    return false;
}