function create_cart_item(store_item_id) {
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        store_item_id: store_item_id
    };


    var obj = new CartItem(crud_type, request_type, key_value_pairs);
    obj.create();
}