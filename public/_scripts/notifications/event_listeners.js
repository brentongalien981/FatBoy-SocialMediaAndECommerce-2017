$("#collapse-notifications-icon").click(function () {
    minimize_notifications_window();
    update_app_settings();
});

$("#expand-notifications-icon").click(function () {
    maximize_notifications_window();
    update_app_settings();
});