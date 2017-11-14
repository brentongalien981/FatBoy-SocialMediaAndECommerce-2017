function do_shipping_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            break;
        case "create":

            //
            disable_all_my_cart_menu_buttons();

            /**/
            is_shipping_address_set = true;

            read_shipping_options();
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

function do_shipping_pre_after_effects(class_name, crud_type, json) {

    /**/
    enable_all_my_cart_menu_buttons();


    // If the response is not successful..
    if (json === null || !json.is_result_ok) {

        window.alert("Oops.. I'm sorry, but there's a little problem. Just get back to this cart a little later..");
    } else if (json.is_result_ok) {
        // Else if it's successful..
    }
}

function disable_all_my_cart_menu_buttons() {

    //
    $("#middle_content").find("button").attr("disabled", "true");
}

function enable_all_my_cart_menu_buttons() {

    //
    $("#middle_content").find("button").removeAttr("disabled");
}

function is_shipping_address_really_set() {

    if (is_shipping_address_set) { return true; }
    else {
        window.alert("Sorry, but you still have to fill in your shipping address..");
        return false;
    }
}