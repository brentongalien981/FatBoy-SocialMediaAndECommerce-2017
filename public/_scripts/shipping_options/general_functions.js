function do_shipping_option_pre_after_effects(class_name, crud_type, json) {

    /**/
    enable_all_my_cart_menu_buttons();

    //
    unset_loader_el();

    //
    $("#shipping-options-container").css("display", "block");


    // If the response is not successful..
    if (json === null || !json.is_result_ok) {

        window.alert("Oops.. I'm sorry, but there's a little problem. Just get back to this cart a little later..");
        $("#shipping-options-error-comment").css("display", "block");
    } else if (json.is_result_ok) {
        // Else if it's successful..
        $("#shipping-options-title").css("display", "block");
        $("#shipping-options-list").css("display", "block");
    }
}

function do_shipping_option_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            display_shipping_options(json.objs);
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

function display_shipping_options(shipping_options) {

    /* Remove the old shipping options. */
    $(".shipping-option").remove();


    /**/
    var so = shipping_options;


    /**/
    for (i = 0; i < so.length; i++) {

        /* */
        var o = so[i];


        /* */
        var so_el = get_shipping_option_el(o);


        /**/
        $("#shipping-options-list").append(so_el);

    }

    $("#shipping-options-container").css("display", "block");
}

function get_shipping_option_el(shipping_option) {

    /**/
    var so = shipping_option;

    /**/
    var so_el = document.createElement("option");
    $(so_el).addClass("shipping-option");
    $(so_el).attr("value", so["shipping_price"]);

    var so_content = so["shipping_company"];
    so_content += " - " + so["shipping_type"];

    so_content += " - Ships in " + so["shipping_days"];
    if (so["shipping_days"] == "1") { so_content += " day"; }
    else { so_content += " days"; }

    so_content += " - USD $" + so["shipping_price"];

    $(so_el).html(so_content);

    /**/
    return so_el;
}