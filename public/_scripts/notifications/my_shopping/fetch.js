async function initialize_my_shopping_notification_fetch() {
    while (!can_my_shopping_notifications_fetch) {
        await my_sleep(2000);
    }

    set_my_shopping_notification_fetcher();
}

function set_my_shopping_notification_fetcher() {
    // Get an update every second.
    my_shopping_notifications_fetch_handler = setInterval(fetch_a_my_shopping_notification, 3000);
}

function fetch_a_my_shopping_notification() {
    // // TODO:DEBUG
    // console.log("**** ++++ ****");
    // console.log("INTERVAL UPDATE");
    // console.log("In METHOD: update_fetch_a_friendship_notification()");

    // //
    // var id = "NotificationMyShoppingContainer"; // x_notification_container_id
    // var container = document.getElementById(id); // x_notification_container

    // // TODO:REMINDER: Change this to a variable.
    // var section = 1;

    /* */
    // Make sure that there is space to fill in
    // in that friendship_notification_container.
    // * Every section should have 10 notifications.

    // // NOTE: The -5 here is the bullshit of html.
    // //       Even though by default, my x_notification_containers
    // //       only has <h4> and <hr>, the code "el.childNodes.length" gives 5.
    // var actual_num_notifications = container.childNodes.length - 5; // The number of noti. in that specific x container.
    // var supposed_num_notifications = section * num_notifications_per_section;


    var latest_notification_date = get_notification_with_latest_date("NotificationMyShopping");

    // // Why <= 5 is explained above.
    // if (container.childNodes.length <= 5) { section = 0; }

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_notification_date: latest_notification_date
    };


    var obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
    obj.fetch();






    // // Here, allow an update even though there's no place to fill
    // // the possibly fetched notification.
    // // I decided to do that (differently compare to the update of NotificationFriendship)
    // // so that I can replace a notification that has the same invoice_item_id, but
    // // different status date. Replace it with a newer status date.
    // if (actual_num_notifications <=  supposed_num_notifications) {
    //     var x_notification_obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
    //     x_notification_obj.update();
    // }
}