function do_session_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            break;
        case "create":
            break;
        case "update":
            read_cart_items();
            // window.alert("oh yea");
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}