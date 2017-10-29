function get_invoice_items_container() {
    var invoice_items_container = document.createElement("div");
    invoice_items_container.setAttribute("class", "invoice-items-containers");

    return invoice_items_container;
}

function get_invoice_item_img_el(invoice_item) {

    /**/
    var ii = invoice_item;


    /**/
    var invoice_item_img_el = document.createElement("img");
    $(invoice_item_img_el).addClass("invoice-item-imgs");
    $(invoice_item_img_el).attr("src", ii["item_photo_address"]);


    /**/
    return invoice_item_img_el;
}

function get_invoice_item_details_el(invoice_item) {

    /**/
    var ii = invoice_item;


    /**/
    var invoice_item_details_el = document.createElement("table");
    $(invoice_item_details_el).addClass("invoice-item-details");




    /* invoice_item_x */
    var invoice_item_id_row_el = get_invoice_item_x_row_el("Item Id", ii["invoice_item_id"]);
    var invoice_item_name_row_el = get_invoice_item_x_row_el("Name", ii["item_name"]);
    var invoice_item_price_row_el = get_invoice_item_x_row_el("Bought Price", ii["price_per_item"]);
    var invoice_item_quantity_row_el = get_invoice_item_x_row_el("Quantity", ii["quantity"]);
    var invoice_item_status_row_el = get_invoice_item_x_row_el("Status", ii["invoice_item_status_id"]);



    /**/
    $(invoice_item_details_el).append($(invoice_item_id_row_el));
    $(invoice_item_details_el).append($(invoice_item_name_row_el));
    $(invoice_item_details_el).append($(invoice_item_price_row_el));
    $(invoice_item_details_el).append($(invoice_item_quantity_row_el));
    $(invoice_item_details_el).append($(invoice_item_status_row_el));


    /**/
    return invoice_item_details_el;
}

function get_invoice_item_x_row_el(data_label, data_value) {

    var invoice_item_x_row_el = document.createElement("tr");

    //
    var invoice_item_x_label_el = document.createElement("td");
    $(invoice_item_x_label_el).html(data_label);
    $(invoice_item_x_label_el).addClass("invoice-item-detail-labels");

    //
    var invoice_item_x_value_el = document.createElement("td");
    $(invoice_item_x_value_el).addClass("invoice-item-detail-value");

    if (data_label == "Status") {
        /**/
        var status_select_el = document.createElement("select");

        /**/
        //
        var option1_el = document.createElement("option");
        if (data_value == 1) { $(option1_el).attr("selected", "true"); }
        $(option1_el).attr("value", "1");
        $(option1_el).html("payment being processed");

        //
        var option2_el = document.createElement("option");
        if (data_value == 2) { $(option2_el).attr("selected", "true"); }
        $(option2_el).attr("value", "2");
        $(option2_el).html("refunded");


        //
        var option3_el = document.createElement("option");
        if (data_value == 3) { $(option3_el).attr("selected", "true"); }
        $(option3_el).attr("value", "3");
        $(option3_el).html("on-hold");


        //
        var option4_el = document.createElement("option");
        if (data_value == 4) { $(option4_el).attr("selected", "true"); }
        $(option4_el).attr("value", "4");
        $(option4_el).html("being shipped");


        //
        var option5_el = document.createElement("option");
        if (data_value == 5) { $(option5_el).attr("selected", "true"); }
        $(option5_el).attr("value", "5");
        $(option5_el).html("delivered");


        //
        var option6_el = document.createElement("option");
        if (data_value == 6) { $(option6_el).attr("selected", "true"); }
        $(option6_el).attr("value", "6");
        $(option6_el).html("being applied for refund");


        //
        var option7_el = document.createElement("option");
        if (data_value == 7) { $(option7_el).attr("selected", "true"); }
        $(option7_el).attr("value", "7");
        $(option7_el).html("ok'd by seller to be refunded");


        var option8_el = document.createElement("option");
        if (data_value == 8) { $(option8_el).attr("selected", "true"); }
        $(option8_el).attr("value", "8");
        $(option8_el).html("finalized");
        
        

        /**/
        $(status_select_el).append($(option1_el));
        $(status_select_el).append($(option2_el));
        $(status_select_el).append($(option3_el));
        $(status_select_el).append($(option4_el));
        $(status_select_el).append($(option5_el));
        $(status_select_el).append($(option6_el));
        $(status_select_el).append($(option7_el));
        $(status_select_el).append($(option8_el));

        /**/
        $(invoice_item_x_value_el).append($(status_select_el));
    }
    else {
        $(invoice_item_x_value_el).html(data_value);
    }


    /**/
    $(invoice_item_x_row_el).append($(invoice_item_x_label_el));
    $(invoice_item_x_row_el).append($(invoice_item_x_value_el));

    /**/
    return invoice_item_x_row_el;
}