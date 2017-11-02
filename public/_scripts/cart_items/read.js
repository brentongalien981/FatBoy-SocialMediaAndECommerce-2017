function read_cart_items() {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        shit: "shit"
    };


    var obj = new CartItem(crud_type, request_type, key_value_pairs);
    obj.read();

}