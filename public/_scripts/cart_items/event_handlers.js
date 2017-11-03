function add_listener_to_cart_item_quantity_input(input, cart_item) {

    var ci = cart_item;

    /**/
    input.change(function () {
        if (is_cart_item_updating) { return; }
        is_cart_item_updating = true;

        var new_quantity = input.val();
        var old_quantity = ci["quantity"];
        var cart_item_id = ci["cart_item_id"];
        var store_item_id = ci["store_item_id"];

        /*
        Revert the value back to the old value. It will be updated anyway
        if the json is successful.
        */
        input.val(old_quantity);


        /**/
        $("#continue-to-shipping-address-btn").attr("disable", "true");
        // $("#continue-to-shipping-address-btn").attr("disable", "true");

        /**/
        update_cart_item(new_quantity, old_quantity, cart_item_id, store_item_id);
    });
}