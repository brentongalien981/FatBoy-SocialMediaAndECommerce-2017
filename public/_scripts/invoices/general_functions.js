function do_invoice_pre_after_effects(class_name, crud_type, json) {
    is_invoice_reading = false;
}

function do_invoice_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_invoices(json);

            // window.alert("aosdjf;asdlf");
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

function get_num_of_invoices() {

    var invoices = $(".invoices");
    var length = invoices.length;


    if (invoices == null ||
        length == null) {

        return 0;
    }
    else {
        return length;
    }
}

function display_invoices(json) {

    //
    var invoices = json.objs;

    //
    for (i = 0; i < invoices.length; i++) {

        /* */
        var invoice = invoices[i];

        /**/
        var invoice_container = get_an_invoice_container(invoice["invoice_id"]);

        /**/
        var invoice_details_options_container = get_invoice_details_options_container();



        /**/
        var invoice_details_container = get_invoice_details_container(invoice);



        /* Append */
        $(invoice_container).append($(invoice_details_options_container));
        $(invoice_container).append($(invoice_details_container));
        // $(invoice_container).append($(invoice_items_containers));


        /**/
        $("#main_content").append($(invoice_container));

        /* Re-append the reference el. */
        $("#main_content").append($("#read-more-invoices-initiator-reference"));


        /**/
        read_invoice_items(invoice["invoice_id"]);

    }

}