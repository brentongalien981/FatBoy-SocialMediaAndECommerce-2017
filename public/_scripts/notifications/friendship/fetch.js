async function initialize_friendship_notification_fetch() {
    while (!can_friendship_notifications_fetch) {
        await my_sleep(2000);
    }

    set_friendship_notification_fetcher();
}

function set_friendship_notification_fetcher() {
    // Get an update every second.
    friendship_notifications_fetch_handler = setInterval(fetch_a_friendship_notification, 3000);
}

function fetch_a_friendship_notification() {

    var latest_notification_date = get_notification_with_latest_date("NotificationFriendship");

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_notification_date: latest_notification_date
    };


    var obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
    obj.fetch();
}