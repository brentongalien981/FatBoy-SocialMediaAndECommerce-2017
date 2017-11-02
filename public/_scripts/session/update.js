function update_session(cart_id) {
    var crud_type = "update";
    var request_type = "POST";

    cart_id = (cart_id != null) ? cart_id : 0;

    var key_value_pairs = {
        update: "yes",
        cart_id: cart_id
    };


    var obj = new Session(crud_type, request_type, key_value_pairs);
    obj.update();
}