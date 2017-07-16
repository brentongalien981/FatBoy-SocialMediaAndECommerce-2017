function add_listener_to_unfollow_button(unfollow_button) {
    unfollow_button.addEventListener("click", function () {
        delete_muse_friendship_record(unfollow_button);
        console.log("EVENT:CLICK:unfollow_button: " + unfollow_button.id);
    });
}



function delete_muse_friendship_record(unfollow_button) {
    var crud_type = "delete";
    var request_type = "POST";

    var muse_user_id = unfollow_button.getAttribute("friend_id");
    var key_value_pairs = {
        delete : "yes",
        muse_user_id : muse_user_id
    };

    var friendship_muse_obj = new FriendshipMuse(crud_type, request_type, key_value_pairs);
    friendship_muse_obj.delete()
}