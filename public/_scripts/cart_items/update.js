function update_cart_item(new_quantity, old_quantity, cart_item_id, store_item_id) {
    var crud_type = "update";
    var request_type = "POST";

    var key_value_pairs = {
        update: "yes",
        new_quantity: new_quantity,
        old_quantity: old_quantity,
        cart_item_id: cart_item_id,
        store_item_id: store_item_id
    };


    var obj = new CartItem(crud_type, request_type, key_value_pairs);
    obj.update();
}

function dom_update_cart_item_stock_input(x_obj, json) {
    /**/
    var cart_item_id = x_obj.key_value_pairs["cart_item_id"];
    var new_quantity = x_obj.key_value_pairs["new_quantity"];

    /**/
    $("#cart-item" + cart_item_id).find(".cart-item-quantity").attr("old-value", new_quantity);
    $("#cart-item" + cart_item_id).find(".cart-item-quantity").val(new_quantity);

    /**/
    console.log("##########################");
    console.log("success cart_item-ajax-update");
    console.log("##########################");
}