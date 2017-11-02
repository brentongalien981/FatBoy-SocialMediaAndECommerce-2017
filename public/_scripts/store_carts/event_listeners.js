$("#cart-list").change(function () {
    // var update_what = "cart_id";
    // window.alert("cart_id: " + $(this).val());
    var cart_id = $(this).val();
    update_session(cart_id);
});