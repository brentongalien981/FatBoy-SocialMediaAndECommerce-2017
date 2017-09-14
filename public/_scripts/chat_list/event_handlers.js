function add_listener_to_chat_button(button) {
    $(button).click(function () {
        manage_thread($(button).attr("user-id"));
    });
}