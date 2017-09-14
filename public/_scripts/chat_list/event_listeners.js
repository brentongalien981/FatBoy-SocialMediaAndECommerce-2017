$("#collapse-chat-list-icon").click(function () {
    $("#chat-list").css("display", "none");
    $(this).css("display", "none");
    $("#expand-chat-list-icon").css("display", "block");

    // $("#notifications-menu-bar").css("border-radius", "5px");
});

$("#expand-chat-list-icon").click(function () {
    $("#chat-list").css("display", "block");
    $("#expand-chat-list-icon").css("display", "none");
    $("#collapse-chat-list-icon").css("display", "block");

    // $("#notifications-menu-bar").css("border-bottom-left-radius", "0px");
    // $("#notifications-menu-bar").css("border-bottom-right-radius", "0px");
});