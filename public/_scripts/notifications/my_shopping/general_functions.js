function do_notification_my_shoppings_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            prepare_notification_x_container(class_name)
            var container = get_actual_notification_x_container(class_name);

            //
            populate_x_notification_container(container, json.notifications, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            //
            var container_id = class_name + "ActualContainer";
            var container = document.getElementById(container_id);

            // If there's a replaceable notification, remove that record
            // by calling a delete AJAX. Then just abort the current update AJAX.
            // Leave the actual filling of the new item status update notification
            // to the next AJAX update (the next code chunk).
            if (is_there_replaceable_notification(container, json.notifications, class_name, crud_type)) {

                return;
            }

            // This is left to the actual AJAX update (the filling of the DOM).
            if (is_there_spot_to_fill(container)) {
                populate_x_notification_container(container, json.notifications, class_name, crud_type);
            }

            break;
        case "delete":
            var notification_id = x_obj.key_value_pairs['notification_id'];
            dom_remove_notification(class_name, notification_id);
            break;
    }
}