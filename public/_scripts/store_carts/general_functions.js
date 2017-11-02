function do_store_cart_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            set_cart_elements(json);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}