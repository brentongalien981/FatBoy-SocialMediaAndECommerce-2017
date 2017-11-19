function authenticate_paypal_seller_acount() {

    var crud_type = "read";
    var request_type = "GET";

    var shipping_fee = $("#shipping-fee-summary").html().substring(1);

    var key_value_pairs = {
        read : "yes",
        shit: "shit",
        authenticate_paypal_seller_acount: "yes",
        prepare_paypal_payment_details: "yes",
        shipping_fee: shipping_fee
    };


    var obj = new PaypalSellerAccountAuthentication(crud_type, request_type, key_value_pairs);
    obj.read();
}


function do_paypal_payment_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            window.alert("SUCCESS PaypalSellerAccountAuthentication-ajax-read");
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

function do_paypal_payment_pre_after_effects(class_name, crud_type, json) {

    /**/
    enable_all_my_cart_menu_buttons();

    //
    unset_loader_el();

    //
    $("#payment-pre-status-container").css("display", "block");



    // If the response is not successful..
    if (json === null || !json.is_result_ok) {

        window.alert("Oops.. Sorry, but there's a little problem with your payment. Just get back to it little later..");
        $("#payment-pre-status-container-title").html("Oops.. Sorry, but there's a little problem with your payment. Just get back to it little later..");
    } else if (json.is_result_ok) {
        // Else if it's successful..
        $("#payment-pre-status-container-title").html("This is just a temporary result for your payment.. ;)");
    }
}