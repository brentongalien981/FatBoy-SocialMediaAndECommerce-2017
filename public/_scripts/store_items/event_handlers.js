function prepare_product_creation() {
    // window.alert("in method prepare_product_creation()");

    /* Hide the products. */
    $("#products-container").css("display", "none");
    $(".products").css("display", "none");

    /* Hide the edit-product-list-container. */
    $("#product-items-list-container").css("display", "none");


    /* Prepare the create-product-table. */
    prepare_table_for_product_creation();

    /* */
    set_product_details_table_for_creation();


    /**/
    $("#add-product-btn").css("display", "none");
    $(".cancel-add-product-btn").css("display", "inline-block");
}


function prepare_product_editing() {

    /* Set the layout. */
    maximize_main_content();

    /* Hide the products. */
    $("#products-container").css("display", "none");
    $(".products").css("display", "none");

    /* Clear the previous contents of the prodcut-items-list-container. */
    $("#product-items-list-container").find(".edit-product").remove();


    // /* Prepare the create-product-table. */
    // prepare_table_for_product_creation();

    /* Set the relevant buttons. */
    $("#add-product-btn").css("display", "inline-block");
    $("#edit-products-btn").css("display", "inline-block");
    $(".cancel-add-product-btn").css("display", "inline-block");


    /* Set the container of the product-list. */
    $("#product-items-list-container").css("display", "inline-block");


    /* Re-append the product-list-container-el. */
    $("#main_content").append($("#product-items-list-container"));


    /**
     * Set the product-details-el to display the details
     * of the product being edited.
     */
    $("#main_content").append($("#a-product-details-table-container"));
    $("#a-product-details-table-container").css("display", "inline-block");
    // $("#a-product-details-table-container").find("#product-id-row").css("display", "block");
    set_product_details_table_for_update();



    /* Re-append the reference el. */
    $("#main_content").append($("#read-more-store-items-initiator-reference"));
}

function prepare_table_for_product_creation() {

    /**/
    var product_details_el = $("#a-product-details-table-container");
    product_details_el.css("display", "inline-block");
    product_details_el.find("#product-action-title").html("Add your new product");
    // product_details_el.find("#product-id-row").css("display", "none");
}

function prepare_products_display() {

    /**/
    $("#a-product-details-table-container").css("display", "none");

    /* Hid the prodcut-items-list-container. */
    $("#product-items-list-container").css("display", "none");

    /* Show the products. */
    $("#products-container").css("display", "block");
    $(".products").css("display", "inline-block");
    $("#product-el-template").css("display", "none");

    /**/
    $("#add-product-btn").css("display", "inline-block");
    $(".cancel-add-product-btn").css("display", "none");
}