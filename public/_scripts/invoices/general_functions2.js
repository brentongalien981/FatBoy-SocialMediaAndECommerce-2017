function get_an_invoice_container(invoice_id) {

    /**/
    var invoice_container_el = document.createElement("div");
    invoice_container_el.id = "invoice" + invoice_id;
    $(invoice_container_el).addClass("invoices");
    $(invoice_container_el).addClass("invoice-containers");

    /**/
    return invoice_container_el;

}

function get_invoice_details_options_container() {
    /**/
    var invoice_details_options_container = document.createElement("nav");
    invoice_details_options_container.setAttribute("class", "invoice-details-options-containers");

    /**/
    var invoice_summary_button = document.createElement("button");
    $(invoice_summary_button).addClass("invoice-options-buttons");
    $(invoice_summary_button).addClass("invoice-summary-buttons");
    $(invoice_summary_button).html("Sales Summary");
    set_invoice_summary_button_listeners(invoice_summary_button);

    /**/
    var shipping_details_button = document.createElement("button");
    $(shipping_details_button).addClass("invoice-options-buttons");
    $(shipping_details_button).html("Shipping Details");
    set_shipping_details_button_listeners(shipping_details_button);

    /**/
    var transaction_button = document.createElement("button");
    $(transaction_button).addClass("invoice-options-buttons");
    $(transaction_button).html("Transaction");


    /* Append */
    $(invoice_details_options_container).append($(invoice_summary_button));
    $(invoice_details_options_container).append($(shipping_details_button));
    $(invoice_details_options_container).append($(transaction_button));


    /**/
    return invoice_details_options_container;
}


function get_invoice_details_container(invoice) {

    /**/
    var invoice_details_container = document.createElement("div");
    $(invoice_details_container).addClass("invoice-details-containers");


    /*uki69*/
    var invoice_sales_summary_container_el = get_invoice_sales_summary_container_el(invoice);
    var shipping_details_container_el = get_shipping_details_container_el(invoice);


    /* Append */
    $(invoice_details_container).append($(invoice_sales_summary_container_el));
    $(invoice_details_container).append($(shipping_details_container_el));


    /**/
    return invoice_details_container;

}

function get_invoice_sales_summary_table_el(invoice) {

    /**/
    var i = invoice;


    /**/
    var invoice_details_table_el = document.createElement("table");
    // $(invoice_details_table_el).addClass("invoice-x-details");
    $(invoice_details_table_el).addClass("invoice-details-table");


    /* rows */
    var invoice_id_row_el = get_invoice_x_row_el("Invoice Id", i["invoice_id"]);
    var invoice_order_date_row_el = get_invoice_x_row_el("Order Date", i["human_invoice_order_date"] + " (" + i["invoice_order_date"] + ")");
    var buyer_user_name_row_el = get_invoice_x_row_el("Buyer", i["buyer_user_name"]);


    /* Append the rows. */
    $(invoice_details_table_el).append($(invoice_id_row_el));
    $(invoice_details_table_el).append($(invoice_order_date_row_el));
    $(invoice_details_table_el).append($(buyer_user_name_row_el));


    /**/
    return invoice_details_table_el;
}

function get_shipping_details_table_el(who, invoice) {

    /**/
    var i = invoice;


    /**/
    var shipping_details_table_el = document.createElement("table");
    $(shipping_details_table_el).addClass("invoice-details-table");


    /* rows */
    var address_of_who_el = get_invoice_x_row_el("Address of", who);
    var street1_row_el = get_invoice_x_row_el("street1", i[who + "_street1"]);
    var street2_row_el = get_invoice_x_row_el("street2", i[who + "_street2"]);
    var city_row_el = get_invoice_x_row_el("city", i[who + "_city"]);
    var state_row_el = get_invoice_x_row_el("state", i[who + "_state"]);
    var zip_row_el = get_invoice_x_row_el("zip", i[who + "_zip"]);
    var country_code_row_el = get_invoice_x_row_el("country code", i[who + "_country_code"]);
    var phone_row_el = get_invoice_x_row_el("phone", i[who + "_phone"]);


    /* Append the rows. */
    $(shipping_details_table_el).append($(address_of_who_el));
    $(shipping_details_table_el).append($(street1_row_el));
    $(shipping_details_table_el).append($(street2_row_el));
    $(shipping_details_table_el).append($(city_row_el));
    $(shipping_details_table_el).append($(state_row_el));
    $(shipping_details_table_el).append($(zip_row_el));
    $(shipping_details_table_el).append($(country_code_row_el));
    $(shipping_details_table_el).append($(phone_row_el));


    /**/
    return shipping_details_table_el;
}

//uki69b
function get_invoice_sales_summary_container_el(invoice) {

    /**/
    var invoice_sales_summary_title_el = document.createElement("h4");
    $(invoice_sales_summary_title_el).addClass("invoice-details-title");
    $(invoice_sales_summary_title_el).html("Sales Summary");


    /**/
    var invoice_sales_summary_table_el = get_invoice_sales_summary_table_el(invoice);


    /**/
    var invoice_sales_summary_container_el = document.createElement("div");
    $(invoice_sales_summary_container_el).addClass("invoice-x-details");
    $(invoice_sales_summary_container_el).addClass("invoice-sales-summary-container");

    /* Append */
    $(invoice_sales_summary_container_el).append($(invoice_sales_summary_title_el));
    $(invoice_sales_summary_container_el).append($(invoice_sales_summary_table_el));


    /**/
    return invoice_sales_summary_container_el;

}

function get_shipping_details_container_el(invoice) {

    /**/
    var shipping_details_title_el = document.createElement("h4");
    $(shipping_details_title_el).addClass("invoice-details-title");
    $(shipping_details_title_el).html("Shipping Details");

    /**/
    var buyer_shipping_details_table_el = get_shipping_details_table_el("buyer", invoice);
    var seller_shipping_details_table_el = get_shipping_details_table_el("seller", invoice);

    /**/
    var shipping_details_container_el = document.createElement("div");
    $(shipping_details_container_el).addClass("invoice-x-details");
    $(shipping_details_container_el).addClass("shipping-details-container");

    /* Append */
    $(shipping_details_container_el).append($(shipping_details_title_el));
    $(shipping_details_container_el).append($(buyer_shipping_details_table_el));
    $(shipping_details_container_el).append($(seller_shipping_details_table_el));

    /**/
    return shipping_details_container_el;

}

function get_invoice_x_row_el(data_label, data_value) {

    var invoice_x_row_el = document.createElement("tr");

    //
    var invoice_x_label_el = document.createElement("td");
    $(invoice_x_label_el).html(data_label);
    $(invoice_x_label_el).addClass("invoice-detail-labels");

    //
    var invoice_x_value_el = document.createElement("td");
    $(invoice_x_value_el).html(data_value);
    $(invoice_x_value_el).addClass("invoice-detail-value");

    /**/
    $(invoice_x_row_el).append($(invoice_x_label_el));
    $(invoice_x_row_el).append($(invoice_x_value_el));

    /**/
    return invoice_x_row_el;
}

function get_invoice_items_containers() {

    /**/
    var invoice_items_container = document.createElement("div");
    $(invoice_items_container).addClass("invoice-items-containers");

    /**/
    return invoice_items_container;
}