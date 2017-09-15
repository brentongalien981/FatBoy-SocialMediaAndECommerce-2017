$("#friend-list-icon").click(function () {

    if ($("#chat-list").css("display") == "none") {
        $("#chat-list").css("display", "block");
    }
    else {
        $("#chat-list").css("display", "none");
    }

});

$("#expand-chat-list-icon").click(function () {
    show_chat_pod();

});

$("#collapse-chat-list-icon").click(function () {
    hide_chat_pod();
});