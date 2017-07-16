function do_notification_friendships_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            // Container_id = notification_info.class_name + “container”
            var container_id = class_name + "Container";
            // Container = clone_categorized_noti_templ(container_id)
            var container = clone_categorized_notification_template(container_id);

            //
            console.log("*********** ++++++ *********");
            console.log("calling METHOD: populate_container()");
            populate_x_notification_container(container, json.notifications, class_name, crud_type);

            //
            console.log("*********** ++++++ *********");
            console.log("UKINNAYO MET!");

            break;
        case "create":
            break;
        case "update":
            //
            var container_id = class_name + "Container";
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