function read_post_notification_objs() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_dom_notifications("NotificationPost");

    var key_value_pairs = {
        read: "yes",
        // section: 1
        offset: offset
    };


    //
    var obj = new NotificationPost(crud_type, request_type, key_value_pairs);
    obj.read();
}


function get_content_for_post_notification(notification) {
    var n = notification;
    var msg = "";


    // CJ rated your post “[Conor McGregor knocked Floyd Ma...]” “bomb”.

    msg += " " + n["notifier_user_name"];
    msg += " rated your ";
    msg += "<a href='#'>";
    msg += "post";
    msg += "</a> ";
    msg += "\"";
    msg += n["message"].substring(0, 100) + "... ";
    msg += "\"";
    msg += "\"" + n["rate_tag"] + "\".";
    msg += " (" + n["date_updated"] + ")";

    //
    return msg;
}