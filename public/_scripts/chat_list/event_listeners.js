$("#friend-list-icon").click(function () {

    if ($("#chat-list").css("display") == "none") {
        $("#chat-list").css("display", "block");
    }
    else {
        $("#chat-list").css("display", "none");
    }

});

$("#expand-chat-list-icon").click(function () {
    $("#chat-wall").css("display", "block");
    $("#chat-textarea-container").css("display", "block");
    $("#keyboard-area").css("display", "block");
    $("#collapse-chat-list-icon").css("display", "block");
    $(this).css("display", "none");
});

$("#collapse-chat-list-icon").click(function () {
    $("#chat-wall").css("display", "none");
    $("#chat-textarea-container").css("display", "none");
    $("#keyboard-area").css("display", "none");
    $("#expand-chat-list-icon").css("display", "block");
    $(this).css("display", "none");
});