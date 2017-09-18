function add_listener_to_chat_button(button) {
    $(button).click(function () {
        manage_thread(button);
    });
}

function show_chat_pod() {
    $("#chat-pod").css("display", "block");
    $("#chat-wall").css("display", "block");
    $("#chat-textarea-container").css("display", "block");
    $("#keyboard-area").css("display", "block");
    $("#collapse-chat-pod-icon").css("display", "block");
    $("#expand-chat-pod-icon").css("display", "none");

    set_chat_list_borders();
    set_chat_menu_bar_borders();
}

function hide_chat_pod() {
    $("#chat-pod").css("display", "none");
    $("#chat-wall").css("display", "none");
    $("#chat-textarea-container").css("display", "none");
    $("#keyboard-area").css("display", "none");
    $("#expand-chat-pod-icon").css("display", "block");
    $("#collapse-chat-pod-icon").css("display", "none");

    set_chat_list_borders();
    set_chat_menu_bar_borders();

}

function maximize_chat_list_window() {
    // show_chat_pod();
    $("#chat-list").css("display", "block");
}

function minimize_chat_list_window() {
    // hide_chat_pod();
    $("#chat-list").css("display", "none");
}

function maximize_chat_pod_window() {
    // $("#chat-pod").css("display", "block");
    show_chat_pod();
}

function minimize_chat_pod_window() {
    // $("#chat-pod").css("display", "none");
    hide_chat_pod();
}

function set_chat_list_borders() {
    if ($("#chat-pod").css("display") == "block") {
        $("#chat-list").css("border-bottom-left-radius", "0px");
        $("#chat-list").css("border-bottom-right-radius", "0px");
    }
    else {
        $("#chat-list").css("border-bottom-left-radius", "5px");
        $("#chat-list").css("border-bottom-right-radius", "5px");

    }

}

function set_chat_menu_bar_borders() {
    if ($("#chat-list").css("display") == "block" ||
        $("#chat-pod").css("display") == "block") {

        $("#chat-list-menu-bar").css("border-bottom-left-radius", "0px");
        $("#chat-list-menu-bar").css("border-bottom-right-radius", "0px");
    }
    else {
        $("#chat-list-menu-bar").css("border-bottom-left-radius", "5px");
        $("#chat-list-menu-bar").css("border-bottom-right-radius", "5px");
    }
}

function set_chat_pod_borders() {

}