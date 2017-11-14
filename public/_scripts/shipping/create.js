function create_shipping_address() {
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        shipping_street1: $("#shipping-street1-input").val(),
        shipping_street2: $("#shipping-street2-input").val(),
        shipping_city: $("#shipping-city-input").val(),
        shipping_state: $("#shipping-state-input").val(),
        shipping_zip: $("#shipping-zip-input").val(),
        shipping_country_code: $("#shipping-country-code-input").val(),
        shipping_phone: $("#shipping-phone-input").val()
    };


    var obj = new Shipping(crud_type, request_type, key_value_pairs);
    obj.create();
}