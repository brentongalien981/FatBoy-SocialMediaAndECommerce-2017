function add_listener_to_accept_follow_request_link(notification) {
    var n = notification;
    var accept_follow_request_link = document.getElementById("accept_follow_request_link" + n['notification_id']);

    accept_follow_request_link.addEventListener("click", function () {
        console.log("TODO:EVENT: click for accept link: " + accept_follow_request_link.id);
        // delete_x_notification_obj(class_name, n['notification_id']);
    });
}