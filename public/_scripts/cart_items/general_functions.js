function do_cart_item_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            remove_previous_cart_items();
            display_cart_items(x_obj, json);
            break;
        case "create":
            break;
        case "update":
            dom_update_cart_item_stock_input(x_obj, json);
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}

function display_cart_items(x_obj, json) {

    //
    var cart_items = json.objs;


    /**/
    for (i = 0; i < cart_items.length; i++) {

        /* */
        var ci = cart_items[i];


        /* cart item details */
        var cart_item_details_el = get_cart_item_details_el(ci);


        /**/
        $("#cart-items-container").append(cart_item_details_el);

    }

    /**/
    if (cart_items.length > 0) {
        $("#empty-cart-item-comment").css("display", "none");
    }
    else {
        $("#empty-cart-item-comment").css("display", "block");
    }

}

function do_cart_item_pre_after_effects(class_name, crud_type, json) {
    is_cart_item_updating = false;
    $("#continue-to-shipping-address-btn").removeAttr("disable");
}