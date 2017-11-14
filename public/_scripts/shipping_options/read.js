function read_shipping_options() {
    //
    set_my_cart_current_step_content(SHIPPING_OPTION_SELECTION);

    set_loader_el("main_content", "We are searching for the best shipping options for you..");

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        shit: "shit"
    };


    var obj = new ShippingOption(crud_type, request_type, key_value_pairs);
    obj.read();

}