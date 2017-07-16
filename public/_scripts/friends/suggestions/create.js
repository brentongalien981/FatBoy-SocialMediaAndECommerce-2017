function add_listener_to_accept_follow_request_link(notification) {
    var n = notification;
    var accept_follow_request_link = document.getElementById("accept_follow_request_link" + n['notification_id']);

    accept_follow_request_link.addEventListener("click", function () {
        console.log("TODO:EVENT: click for accept link: " + accept_follow_request_link.id);
        // delete_x_notification_obj(class_name, n['notification_id']);
        create_friendship_record(this);
    });
}



function create_friendship_record(accept_link) {
    // TODO:DEBUG
    console.log("TODO:accept_link.id: " + accept_link.id);
    var crud_type = "create";
    var request_type = "POST";
    var notification_msg_id = 3; // 3 for "UserB accepted your follow request.".

    var friend_id = accept_link.getAttribute("friend_id");
    var notification_id = accept_link.getAttribute("notification_id");
    var key_value_pairs = {
        create : "yes",
        friend_id : friend_id,
        notification_id : notification_id,
        notification_msg_id : notification_msg_id
    };

    var class_name = "Friendship";
    var friendship_obj = new Friendship(class_name, crud_type, request_type, key_value_pairs);
    friendship_obj.create()
}