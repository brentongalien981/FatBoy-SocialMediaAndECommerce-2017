$("#collapse-notifications-icon").click(function () {
    $("#notifications-widget-main-container").css("display", "none");
    $("#collapse-notifications-icon").css("display", "none");
    $("#expand-notifications-icon").css("display", "block");

    $("#notifications-menu-bar").css("border-radius", "5px");
});

$("#expand-notifications-icon").click(function () {
    $("#notifications-widget-main-container").css("display", "block");
    $("#expand-notifications-icon").css("display", "none");
    $("#collapse-notifications-icon").css("display", "block");

    $("#notifications-menu-bar").css("border-bottom-left-radius", "0px");
    $("#notifications-menu-bar").css("border-bottom-right-radius", "0px");
});