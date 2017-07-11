/* Event listeners */
function add_listener_to_follow_button(follow_button) {
    follow_button.addEventListener("click", function () {
        var crud_type = "create";
        var request_type = "POST";

        var friend_id = follow_button.getAttribute("friend_id");
        var key_value_pairs = {
            create : "yes",
            friend_id : friend_id,
            notification_msg_id : 2
        };

        var notification_friendship_obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
        notification_friendship_obj.create()

    });
}


/* Event handlers */