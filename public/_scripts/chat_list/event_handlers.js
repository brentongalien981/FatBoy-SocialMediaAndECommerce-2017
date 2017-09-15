function add_listener_to_chat_button(button) {
    $(button).click(function () {
        manage_thread(button);
    });
}

function show_chat_pod() {
    $("#chat-wall").css("display", "block");
    $("#chat-textarea-container").css("display", "block");
    $("#keyboard-area").css("display", "block");
    $("#collapse-chat-list-icon").css("display", "block");
    $("#expand-chat-list-icon").css("display", "none");
}

function hide_chat_pod() {

    $("#chat-wall").css("display", "none");
    $("#chat-textarea-container").css("display", "none");
    $("#keyboard-area").css("display", "none");
    $("#expand-chat-list-icon").css("display", "block");
    $("#collapse-chat-list-icon").css("display", "none");
}