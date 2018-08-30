/* event_listeners.js */
$("#notification-widget-btn").click(function () {

    // Disable this btn.
    $(this).attr("disabled", "true");

    setNotificationWidget();
});