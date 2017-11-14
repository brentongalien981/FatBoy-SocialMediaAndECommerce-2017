$("#cart-list").change(function () {
    // var update_what = "cart_id";
    // window.alert("cart_id: " + $(this).val());
    var cart_id = $(this).val();
    update_session(cart_id);
});

$(".continue-to-shipping-address-btn").click(function () {

    /**/
    set_my_cart_current_step_content(SHIPPING_ADDRESS_FILLING);


});

$(".go-to-cart-selection-btn").click(function () {

    //
    set_my_cart_current_step_content(CART_SELECTION);
});