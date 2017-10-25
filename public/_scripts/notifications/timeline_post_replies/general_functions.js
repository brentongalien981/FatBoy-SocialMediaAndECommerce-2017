function do_notification_timeline_post_replies_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "fetch":
            break;
        case "read":
            break;
        case "create":
            console.log("SUCCESS on notifying all subscribers on that post about that comment.");
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}