async function initialize_friendship_notification_update() {
    while (!can_friendship_notifications_update) {
        await my_sleep(2000);
    }

    set_friendship_notification_updater();
}


function set_friendship_notification_updater() {
    // Get an update every second.
    friendship_notifications_update_handler = setInterval(update_fetch_a_friendship_notification, 3000);
}


function update_fetch_a_friendship_notification() {
    // // TODO:DEBUG
    // console.log("**** ++++ ****");
    // console.log("INTERVAL UPDATE");
    // console.log("In METHOD: update_fetch_a_friendship_notification()");

    // TODO:REMINDER: Change this to a variable.
    var section = 1;

    var crud_type = "update";
    var request_type = "GET";
    var key_value_pairs = {
        update : "yes",
        section: section
    };


    /* */
    // Make sure that there is space to fill in
    // in that friendship_notification_container.
    // * Every section should have 10 notifications.

    //
    var id = "NotificationFriendshipContainer"; // x_notification_container_id
    var container = document.getElementById(id); // x_notification_container
    var actual_num_notifications = container.childNodes.length; // The number of noti. in that specific x container.
    var supposed_num_notifications = section * num_notifications_per_section;



    //
    if (actual_num_notifications <  supposed_num_notifications) {
        var x_notification_obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
        x_notification_obj.update();
    }
}