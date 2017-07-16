function add_listener_to_unfollow_button(unfollow_button) {
    unfollow_button.addEventListener("click", function () {
        // create_friendship_notification(follow_button);
        console.log("EVENT:CLICK:unfollow_button: " + unfollow_button.id);
    });
}