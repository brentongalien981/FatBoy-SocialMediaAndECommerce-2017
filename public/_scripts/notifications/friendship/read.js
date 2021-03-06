function read_friendship_notification_objs() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";

    var offset = get_num_of_dom_notifications("NotificationFriendship");

    var key_value_pairs = {
        read: "yes",
        // section: 1
        offset: offset
    };


    //
    var obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
    obj.read();
}


function get_notification_for_follow_request(notification) {
    var n = notification;
    var msg = "";


    // A follow request.
    // Delete link.
    // msg += "<a notification_id='" + n['notification_id'] + "'";
    // msg += " href='#'";
    // msg += " class='delete_friend_notification_links'";
    // msg += ">x";
    // msg += "</a>";

    // Accept link.
    msg += " <a";
    msg += " target='_blank'";
    msg += " href='" + get_local_url() + "/public/__controller/controller_friends.php?view_friend_account=yes";
    msg += " &friend_id=" + n['notifier_user_id'];
    msg += " &friend_name=" + n['user_name'];
    msg += "'";
    msg += " class='friend_notification_links'>";
    msg += n['user_name'];
    msg += "</a> wants to follow you ";

    msg += "<a";
    msg += " id='accept_follow_request_link" + n['notification_id'] + "'";
    msg += " class='friend_notification_links accept_follow_request_links'";
    msg += " friend_id='" + n['notifier_user_id'] + "'";
    msg += " notification_id='" + n['notification_id'] + "'";
    msg += ">accept</a>";

    msg += "<i class='my-time-stamp'>(" + n["human_date"] + ")</i>";

    //
    return msg;
}


function get_notification_for_follow_acceptance(notification) {
    var n = notification;
    var msg = "";


    // A follow acceptance
    msg += " <a";
    msg += " target='_blank'";
    msg += " href='" + get_local_url() + "/public/__controller/controller_friends.php?view_friend_account=yes";
    msg += " &friend_id=" + n['notifier_user_id'];
    msg += " &friend_name=" + n['user_name'];
    msg += "'";
    msg += " class='friend_notification_links'>";
    msg += n['user_name'];
    msg += "</a>";

    msg += " accepted your follow request ";

    msg += "<i class='my-time-stamp'>(" + n["human_date"] + ")</i>";

    //
    return msg;
}