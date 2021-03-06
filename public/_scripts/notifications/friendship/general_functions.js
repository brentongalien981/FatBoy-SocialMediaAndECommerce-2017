function do_notification_friendships_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "fetch":
            // console.log("TODO: FILE: general_functions.js, METHOD: do_notification_rateable_items_after_effects(), switch case: \"fetch\"");

            //
            // prepare_notification_x_container(class_name);
            var container = get_actual_notification_x_container(class_name);

            //
            dom_remove_outdated_notifications(json.notifications);
            populate_x_notification_container2(container, json.notifications, class_name, crud_type);
            break;
        case "read":
            // // Container_id = notification_info.class_name + “container”
            // var container_id = class_name + "Container";
            // // Container = clone_categorized_noti_templ(container_id)
            // var container = clone_categorized_notification_template(container_id);
            prepare_notification_x_container(class_name)
            var container = get_actual_notification_x_container(class_name);

            //
            populate_x_notification_container2(container, json.notifications, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            //
            var container_id = class_name + "ActualContainer";
            var container = document.getElementById(container_id);

            // if (container == null) {
            //     // That means the first initial read hasn't fetched any record,
            //     // so just call this method again, but change the crud_type to
            //     // read instead of update.
            //
            //     // do_notification_friendships_after_effects(class_name, "read", json, x_obj)
            //     container = clone_categorized_notification_template(container_id);
            // }

            populate_x_notification_container(container, json.notifications, class_name, crud_type);

            break;
        case "delete":
            // TODO:REMINDER
            var notification_id = x_obj.key_value_pairs['notification_id'];
            dom_remove_notification(class_name, notification_id);
            console.log();
            break;
    }
}