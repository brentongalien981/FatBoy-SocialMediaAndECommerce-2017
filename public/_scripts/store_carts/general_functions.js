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

function does_cart_contain_item() {
    var cart_item_quantity_inputs = $(".cart-item-quantity");
    var actual_cart_item_quantity_inputs_length = cart_item_quantity_inputs.length - 1; // Minus one for the template.

    /* */
    if (actual_cart_item_quantity_inputs_length <= 0) { return false; }


    /**/
    var total_num_of_cart_items = 0;


    /**/
    for (i = 0; i < cart_item_quantity_inputs.length; i++) {

        /**/
        var input = cart_item_quantity_inputs[i];

        /* You might reference the template, so just disregard it. */
        if ($(input).val() == -69) { continue; }

        /**/
        total_num_of_cart_items += parseInt($(input).val());


        /**/
        if (total_num_of_cart_items > 0) { return true; }
    }

    window.alert("Sorry but you don't have any item in your cart..");
    return false;
}


function hide_cart_menu_containers() {
    $(".cart-menu-containers").css("display", "none");
}
