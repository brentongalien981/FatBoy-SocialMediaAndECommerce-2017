function update_store_item() {
    var crud_type = "update";
    var request_type = "POST";

    var key_value_pairs = {
        update: "yes",
        product_id: $("#product-id").val(),
        product_name: $("#product-name").val(),
        product_price: $("#product-price").val(),
        product_quantity: $("#product-quantity").val(),
        product_description: $("#product-description").val(),
        product_photo_src: $("#product-photo-src").val(),
        product_mass: $("#product-mass").val(),
        product_length: $("#product-length").val(),
        product_width: $("#product-width").val(),
        product_height: $("#product-height").val()
    };


    var obj = new StoreItem(crud_type, request_type, key_value_pairs);
    obj.update();
}