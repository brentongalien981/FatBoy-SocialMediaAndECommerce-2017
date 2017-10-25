function do_notification_timeline_post_replies_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "fetch":
            break;
        case "read":
            //
            prepare_notification_x_container(class_name);

            var container = get_actual_notification_x_container(class_name);

            //
            populate_x_notification_container2(container, json.notifications, class_name, crud_type);

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