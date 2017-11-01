function do_store_item_pre_after_effects(class_name, crud_type, json) {
    is_store_item_reading = false;
}

function do_store_item_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            /**/
            var for_what = x_obj.key_value_pairs["for_what"];

            if (for_what == "edit") { list_store_items_for_edit(json); }
            else { display_store_items(json); }

            break;
        case "create":
            window.alert("Yeah! You've successfully added your new product..");
            
            clear_product_details_input_fields();
            break;
        case "update":
            window.alert("Yeah! You've successfully updated your product..");
            reset_product_details_table();
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}

function display_store_items(json) {

    //
    var store_items = json.objs;

    //
    for (i = 0; i < store_items.length; i++) {

        /* */
        var si = store_items[i];

        /**/
        var product_el = get_product_el(si);


        /* Append the product-el. */
        $("#main_content").append($(product_el));


        /* Re-append the reference el. */
        $("#main_content").append($("#read-more-store-items-initiator-reference"));
    }

}

function get_product_el(store_item) {

    /**/
    var si = store_item;

    /**/
    var product_el = $("#product-el-template").clone(true);
    product_el.id = "product" + si["product_id"];
    $(product_el).css("display", "inline-block");


    /* Edit the product-el's contents. */
    $(product_el).find(".product-name").html(si["product_name"]);
    //
    $(product_el).find(".product-price").html("$" + si["product_price"]);
    //
    $(product_el).find(".product-stock-quantity").html(si["product_quantity"] + " items remaining");
    //
    $(product_el).find(".product-img").attr("src", si["product_photo_address"]);
    $(product_el).find(".product-img").attr("alt", si["product_name"] + " image");
    //
    $(product_el).find(".product-description").html(si["product_description"]);
    //
    $(product_el).find(".product-seller").html("Seller: " + si["seller_user_name"]);
    //
    // $(product_el).find(".product-rating").html("Customer Rating: " + si["seller_user_name"]);



    /**/
    return product_el;

}


function get_product_for_edit_el(store_item) {

    /**/
    var si = store_item;

    /**/
    var product_el = $("#edit-product-template").clone(true);
    product_el.id = "edit-product" + si["product_id"];
    $(product_el).css("display", "block");


    /* Edit the product-el's contents. */
    //
    $(product_el).find(".edit-product-id").html(si["product_id"]);
    //
    $(product_el).find(".edit-product-name").html(si["product_name"]);
    //
    $(product_el).find(".edit-product-img").attr("src", si["product_photo_address"]);
    $(product_el).find(".edit-product-img").attr("alt", si["product_name"] + " image");
    //
    // $(product_el).find(".edit-product-select-btn").html(si["product_name"]);


    /**/
    $(product_el).find(".edit-product-select-btn").click(function () {
        populate_product_details_table(si);
    });


    /**/
    return product_el;

}

function clear_product_details_input_fields() {

    /**/
    $("#a-product-details-table-container").find("input").val("");
    $("#a-product-details-table-container").find("textarea").val("");
}

function list_store_items_for_edit(json) {

    //
    var store_items = json.objs;

    //
    for (i = 0; i < store_items.length; i++) {

        /* */
        var si = store_items[i];

        /* Get the product-for-edit-list. */
        var product_el = get_product_for_edit_el(si);


        /* Append the product-el. */
        $("#product-items-list-container").append($(product_el));

    }


    /* Re-append the edit-more-store-items-initiator-reference to the bottom. */
    $("#product-items-list-container").append($("#edit-more-store-items-initiator-reference"));



}