function create_timeline_post_notification(post_id) {
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create : "yes",
        post_id: post_id,
        // notified_user_id : For this instance, this will always be the session->currently_viewed_user_id
        notification_msg_id : 4
    };

    var obj = new NotificationPost(crud_type, request_type, key_value_pairs);
    obj.create()
}