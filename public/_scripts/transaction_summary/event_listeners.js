$(".go-to-transaction-summary-btn").click(function () {

    //
    if (!get_is_shipping_options_set()) {
        window.alert("Sorry, but your shipping option is not set..");
        return;
    }

    /**/
    set_my_cart_current_step_content(TRANSACTION_SUMMARY);

    //
    populate_transaction_summary_container_sections();
});


$(".pay-transaction-incremental-btn").click(function () {

    return;

    //
    set_my_cart_current_step_content(PAYING_TRANSACTION);

    //
    disable_all_my_cart_menu_buttons();
    $("#cancel-payment-temp-btn").removeAttr("disabled");

    set_loader_el("main_content", "We're just preparing your payment.. Props to your patience :)");


    /**/
    authenticate_paypal_seller_acount();
});

$("#cancel-payment-temp-btn").click(function () {

    //
    enable_all_my_cart_menu_buttons();
    unset_loader_el();
});