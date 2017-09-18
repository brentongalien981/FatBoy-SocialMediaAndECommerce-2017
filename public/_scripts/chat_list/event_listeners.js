$("#friend-list-icon").click(function () {

    if ($("#chat-list").css("display") == "none") {
        $("#chat-list").css("display", "block");
    }
    else {
        $("#chat-list").css("display", "none");
    }

    set_chat_list_borders();
    set_chat_menu_bar_borders();
    update_app_settings();

});

$("#expand-chat-pod-icon").click(function () {
    show_chat_pod();
    update_app_settings();

});

$("#collapse-chat-pod-icon").click(function () {
    hide_chat_pod();
    update_app_settings();
});