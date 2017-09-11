function read_rateable_item_notification_objs() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_dom_notifications("NotificationRateableItem");

    var key_value_pairs = {
        read: "yes",
        // section: 1
        offset: offset
    };


    //
    var obj = new NotificationRateableItem(crud_type, request_type, key_value_pairs);
    obj.read();
}


function get_content_for_rateable_item_notification(notification) {
    var n = notification;
    var msg = "";


    // CJ rated your post “[Conor McGregor knocked Floyd Ma...]” “bomb”.

    msg += " " + n["notifier_user_name"];
    msg += " rated your ";
    msg += "<a href='" + get_local_url() + "/public/index.php/#post" + n["post_id" +
    ""] + "'>";
    msg += "post";
    msg += "</a> ";
    msg += "\"";
    msg += n["message"].substring(0, 40) + " ...";
    msg += "\" ";
    msg += "\"" + n["rate_tag"] + "\".";
    msg += " <i class='my-time-stamp'>(" + n["human_date"] + ")</i>";

    //
    return msg;
}