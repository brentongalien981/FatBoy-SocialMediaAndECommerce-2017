async function initialize_rateable_item_notification_fetch() {
    while (!can_rateable_item_notifications_fetch) {
        await my_sleep(2000);
    }

    set_rateable_item_notification_fetcher();
}

function set_rateable_item_notification_fetcher() {
    // Fetch every second.
    rateable_item_notifications_fetch_handler = setInterval(fetch_a_rateable_item_notification, 3000);
}

function fetch_a_rateable_item_notification() {

    var offset = get_num_of_dom_notifications("NotificationRateableItem");
    var latest_notification_date = get_notification_with_latest_date("NotificationRateableItem");

    // window.alert("latest_notification_date: " + latest_notification_date);
    // return;

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_notification_date: latest_notification_date
    };


    var obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
    obj.fetch();
}