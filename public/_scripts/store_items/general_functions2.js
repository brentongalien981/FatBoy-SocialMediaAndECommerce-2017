function set_product_details_table_for_creation() {

    /**/
    $("#a-product-details-table-container").find("#product-action-title").html("Add your new product's details.");

    reset_product_details_table();

    /**/
    $("#create-product-record-btn").css("display", "inline-block");
    $("#update-product-record-btn").css("display", "none");
}

function set_product_details_table_for_update() {

    /**/
    $("#a-product-details-table-container").find("#product-action-title").html("Edit your product's details.");

    reset_product_details_table();

    /**/
    $("#create-product-record-btn").css("display", "none");
    $("#update-product-record-btn").css("display", "inline-block");
}

function populate_product_details_table(store_item) {

    /**/
    var si = store_item;


    /**/
    $("#a-product-details-table-container").find("#product-id").val(si["product_id"]);
    $("#a-product-details-table-container").find("#product-name").val(si["product_name"]);
    $("#a-product-details-table-container").find("#product-price").val(si["product_price"]);
    $("#a-product-details-table-container").find("#product-quantity").val(si["product_quantity"]);
    $("#a-product-details-table-container").find("#product-description").val(si["product_description"]);
    $("#a-product-details-table-container").find("#product-photo-src").val(si["product_photo_address"]);
    $("#a-product-details-table-container").find("#product-mass").val(si["product_mass"]);
    $("#a-product-details-table-container").find("#product-length").val(si["product_length"]);
    $("#a-product-details-table-container").find("#product-width").val(si["product_width"]);
    $("#a-product-details-table-container").find("#product-height").val(si["product_height"]);
}

function reset_product_details_table() {
    $("#a-product-details-table-container").find("input").val("");
    $("#a-product-details-table-container").find("textarea").val("");

    $("#a-product-details-table-container").find(".error_msg").html("zZz");
    $("#a-product-details-table-container").find(".error_msg").css("visibility", "hidden");
}

function get_num_of_store_items() {

    var objs = $(".edit-product");
    var length = parseInt(objs.length) - 1; // Minus 1 because of the template.


    if (objs == null ||
        length == null) {

        return 0;
    }
    else {
        return length;
    }
}