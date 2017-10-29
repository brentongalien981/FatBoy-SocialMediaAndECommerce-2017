function set_invoice_summary_button_listeners(invoice_summary_button) {

    /**/
    $(invoice_summary_button).click(function () {

        var the_invoice_container = $(this).closest(".invoice-containers")[0];

        /**/
        $(the_invoice_container).find($(".invoice-options-buttons")).css("background-color", "white");
        $(this).css("background-color", "rgb(184, 255, 137)");



        /**/
        $(the_invoice_container).find($(".invoice-x-details")).css("display", "none");

        /**/
        $(the_invoice_container).find($(".invoice-sales-summary-container")).css("display", "initial");

    });
}


function set_shipping_details_button_listeners(shipping_details_button) {

    /**/
    $(shipping_details_button).click(function () {

        var the_invoice_container = $(this).closest(".invoice-containers")[0];

        /**/
        $(the_invoice_container).find($(".invoice-options-buttons")).css("background-color", "white");
        $(this).css("background-color", "rgb(184, 255, 137)");

        /**/
        $(the_invoice_container).find($(".invoice-x-details")).css("display", "none");

        /**/
        $(the_invoice_container).find($(".shipping-details-container")).css("display", "initial");

    });
}

