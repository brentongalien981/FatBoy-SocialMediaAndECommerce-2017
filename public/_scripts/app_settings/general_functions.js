function do_app_setting_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            // window.alert(json.objs["notifications_is_maximized"]);
            set_app(json);
            break;
        case "create":
            break;
        case "update":
            // is_app_setting_update_ok = true;
            break;
        case "delete":
            break;
        case "fetch":
            break;
    }
}