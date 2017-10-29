function read_timeline_post_reply_notifications() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_dom_notifications("NotificationTimelinePostReply");
    var latest_notification_date = get_notification_with_latest_date("NotificationTimelinePostReply");
    // var is_very_first_read_bruh = (is_very_first_read == true) ? true : false;

    var key_value_pairs = {
        read: "yes",
        latest_notification_date: latest_notification_date
    };


    //
    var obj = new NotificationTimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.read();
}

function get_content_for_timeline_post_reply_notification(notification) {
    var n = notification;
    var msg = "";


    // CJ commented "ayots to ah:)" a post.

    msg += n["notifier_user_name"] + " commented";
    msg += " \"" + n["message"].substring(0, 40) + " ...\"" + " on a post.";

    // msg += "<a href='" + get_local_url() + "/public/index.php/#post" + n["post_id" +

    msg += " <i class='my-time-stamp'>(" + n["human_date"] + ")</i>";

    //
    return msg;
}