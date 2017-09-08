function do_notification_posts_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            // // // Container_id = notification_info.class_name + “container”
            // // var container_id = class_name + "Container";
            // // // Container = clone_categorized_noti_templ(container_id)
            // // var container = clone_categorized_notification_template(container_id);
            // prepare_notification_x_container(class_name)
            // var container = get_notification_x_container(class_name);
            //
            // //
            // populate_x_notification_container(container, json.notifications, class_name, crud_type);
            break;
        case "create":
            window.alert("TODO: FILE: general_functions.js, METHOD: do_notification_posts_after_effects()");
            break;
        case "update":
            // //
            // var container_id = class_name + "Container";
            // var container = document.getElementById(container_id);
            //
            // populate_x_notification_container(container, json.notifications, class_name, crud_type);

            break;
        case "delete":
            // //
            // var notification_id = x_obj.key_value_pairs['notification_id'];
            // dom_remove_notification(class_name, notification_id);
            // console.log();
            break;
    }
}