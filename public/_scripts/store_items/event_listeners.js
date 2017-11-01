$("#add-product-btn").click(function () {
    prepare_product_creation();
});

$(".cancel-add-product-btn").click(function () {
    prepare_products_display();

    read_store_items();
});

$("#create-product-record-btn").click(function () {
    create_store_item();
});

$("#edit-products-btn").click(function () {

    prepare_product_editing();

    read_store_items("edit");
});

$("#update-product-record-btn").click(function () {

    update_store_item();
});

//
$("#product-items-list-container").scroll(function () {
    if (!is_store_item_reading) {

        /**/
        if (can_i_edit_more_store_items()) {
            is_store_item_reading = true;
            read_store_items("edit");
        }
    }
});