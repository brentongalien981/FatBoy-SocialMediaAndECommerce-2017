function add_listener_to_follow_button(follow_button) {
    follow_button.addEventListener("click", function () {
        create_friendship_notification(follow_button);

    });
}