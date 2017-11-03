function get_cart_item_details_el(cart_item) {

    /**/
    var ci = cart_item;


    /**/
    var cart_item_details_el = $("#cart-item-template").clone(true);
    cart_item_details_el.attr("id", "cart-item" + ci["cart_item_id"]);
    cart_item_details_el.addClass("actual-cart-item");


    /* Fill in the cart-item details. */
    cart_item_details_el.find(".cart-item-img").attr("src", ci["product_photo_address"]);
    cart_item_details_el.find(".cart-item-img").attr("alt", ci["product_name"] + " photo");
    cart_item_details_el.find(".cart-item-name").html(ci["product_name"]);
    cart_item_details_el.find(".cart-item-price").html("$" + ci["product_price"]);
    cart_item_details_el.find(".cart-item-quantity").val(ci["quantity"]);
    cart_item_details_el.find(".cart-item-quantity").attr("stock-quantity", ci["product_stock_quantity"]);
    cart_item_details_el.find(".cart-item-quantity").attr("max", ci["product_stock_quantity"]);
    cart_item_details_el.find(".cart-item-quantity").attr("old-value", ci["quantity"]);
    cart_item_details_el.find(".cart-item-stock-quantity").html(ci["product_stock_quantity"]);


    /* Add event-listener to the quantity input. */
    var cart_item_quantity_input = cart_item_details_el.find(".cart-item-quantity");
    add_listener_to_cart_item_quantity_input(cart_item_quantity_input, ci);

    /**/
    return cart_item_details_el;
}

function remove_previous_cart_items() {
    $(".actual-cart-item").remove();
}