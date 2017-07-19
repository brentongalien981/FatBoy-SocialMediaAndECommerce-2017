function do_notification_my_shoppings_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            prepare_notification_x_container(class_name)
            var container = get_notification_x_container(class_name);

            //
            populate_x_notification_container(container, json.notifications, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            // //
            // var container_id = class_name + "Container";
            // var container = document.getElementById(container_id);
            //
            // populate_x_notification_container(container, json.notifications, class_name, crud_type);

            break;
        case "delete":
            // // TODO:REMINDER
            // var notification_id = x_obj.key_value_pairs['notification_id'];
            // dom_remove_notification(class_name, notification_id);
            // console.log();
            break;
    }
}



function prepare_notification_x_container(class_name) {
    var id = class_name + "Container";
    var container = document.getElementById(id);
    main_content.appendChild(container);
}



function get_notification_x_container(class_name) {
    var id = class_name + "Container";
    var tbody = document.getElementById(id);
    return tbody;
}