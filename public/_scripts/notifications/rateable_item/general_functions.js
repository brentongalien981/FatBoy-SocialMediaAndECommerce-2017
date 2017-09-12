function do_notification_rateable_items_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "fetch":
            console.log("TODO: FILE: general_functions.js, METHOD: do_notification_rateable_items_after_effects(), switch case: \"fetch\"");

            //
            // prepare_notification_x_container(class_name);
            var container = get_actual_notification_x_container(class_name);

            //
            dom_remove_outdated_notifications(json.notifications);
            populate_x_notification_container2(container, json.notifications, class_name, crud_type);
            break;
        case "read":
            window.alert("TODO: FILE: general_functions.js, METHOD: do_notification_rateable_items_after_effects(), switch case: \"read\"");

            //
            prepare_notification_x_container(class_name);
            var container = get_actual_notification_x_container(class_name);

            //
            populate_x_notification_container2(container, json.notifications, class_name, crud_type);
            break;
        case "create":
            window.alert("TODO: FILE: general_functions.js, METHOD: do_notification_rateable_items_after_effects()");
            break;
        case "update":
            break;
        case "delete":
            var notification_id = x_obj.key_value_pairs['notification_id'];
            dom_remove_notification(class_name, notification_id);
            break;
    }
}