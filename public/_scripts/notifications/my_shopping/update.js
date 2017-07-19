async function initialize_my_shopping_notification_update() {
    while (!can_my_shopping_notifications_update) {
        await my_sleep(2000);
    }

    set_my_shopping_notification_updater();
}



function set_my_shopping_notification_updater() {
    // Get an update every second.
    my_shopping_notifications_update_handler = setInterval(update_fetch_a_my_shopping_notification, 3000);
}



function update_fetch_a_my_shopping_notification() {
    // // TODO:DEBUG
    // console.log("**** ++++ ****");
    // console.log("INTERVAL UPDATE");
    // console.log("In METHOD: update_fetch_a_friendship_notification()");

    //
    var id = "NotificationMyShoppingContainer"; // x_notification_container_id
    var container = document.getElementById(id); // x_notification_container

    // TODO:REMINDER: Change this to a variable.
    var section = 1;

    /* */
    // Make sure that there is space to fill in
    // in that friendship_notification_container.
    // * Every section should have 10 notifications.

    // NOTE: The -5 here is the bullshit of html.
    //       Even though by default, my x_notification_containers
    //       only has <h4> and <hr>, the code "el.childNodes.length" gives 5.
    var actual_num_notifications = container.childNodes.length - 5; // The number of noti. in that specific x container.
    var supposed_num_notifications = section * num_notifications_per_section;


    // Why <= 5 is explained above.
    if (container.childNodes.length <= 5) { section = 0; }

    var crud_type = "update";
    var request_type = "GET";
    var key_value_pairs = {
        update : "yes",
        section: section
    };






    // Here, allow an update even though there's no place to fill
    // the possibly fetched notification.
    // I decided to do that (differently compare to the update of NotificationFriendship)
    // so that I can replace a notification that has the same invoice_item_id, but
    // different status date. Replace it with a newer status date.
    if (actual_num_notifications <=  supposed_num_notifications) {
        var x_notification_obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
        x_notification_obj.update();
    }
}


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