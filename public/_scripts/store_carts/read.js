function read_store_carts() {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        shit: "shit"
    };


    var obj = new StoreCart(crud_type, request_type, key_value_pairs);
    obj.read();

}

function set_cart_elements(json) {

    //
    var store_carts = json.objs;
    var cart_id = json.cart_id;

    //
    for (i = 0; i < store_carts.length; i++) {

        /* */
        var sc = store_carts[i];

        /**/
        var cart_el = get_cart_el(sc, cart_id);


        /* Append the product-el. */
        $("#cart-list").append($(cart_el));
    }
}

function get_cart_el(cart_item, cart_id) {

    /**/
    var sc = cart_item;

    /**/
    var cart_el = document.createElement("option");
    cart_el.id = "cart" + sc["cart_id"];
    $(cart_el).attr("value", sc["cart_id"]);
    if (cart_id == sc["cart_id"]) { $(cart_el).attr("selected", "true") ;}
    $(cart_el).html(sc["seller_user_name"] + "'s store" );


    /**/
    return cart_el;

}