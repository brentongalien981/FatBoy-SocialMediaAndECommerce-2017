function do_invoice_item_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_invoice_items(x_obj, json);

            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}

function display_invoice_items(x_obj, json) {

    //
    var invoice_items = json.objs;
    var invoice_id = x_obj.key_value_pairs["invoice_id"];


    /* Append the "Order-items" title. */
    var order_items_title_el = document.createElement("h4");
    $(order_items_title_el).addClass("invoice-details-title");
    $(order_items_title_el).addClass("invoice-item-title");
    $(order_items_title_el).html("Order Items");
    $("#invoice" + invoice_id).append($(order_items_title_el));



    /**/
    for (i = 0; i < invoice_items.length; i++) {

        /* */
        var ii = invoice_items[i];

        /**/
        var invoice_items_container = get_invoice_items_container();


        /* invoice item img */
        var invoice_item_img_el = get_invoice_item_img_el(ii);


        /* invoice item details */
        var invoice_item_details_el = get_invoice_item_details_el(ii);


        /**/
        $(invoice_items_container).append($(invoice_item_img_el));
        $(invoice_items_container).append($(invoice_item_details_el));


        /**/
        $("#invoice" + invoice_id).append($(invoice_items_container));


        /**/
        if (i == invoice_items.length - 1) {
            $(invoice_items_container).addClass("last-item-containers");
        }

    }

}

function set_status_of_invoice_item(x_obj) {
    var invoice_id = x_obj.key_value_pairs["the_invoice_id"];
    var invoice_item_id = x_obj.key_value_pairs["the_invoice_item_id"];
    var new_invoice_item_status_id = x_obj.key_value_pairs["new_invoice_item_status_id"];

    /* Reference the sales-summary-table of the invoice-item. */
    var invoice_item_table = $("#invoice-item" + invoice_item_id);

    /* Set the value of the select-el. */
    invoice_item_table.find("select").val(new_invoice_item_status_id);
}