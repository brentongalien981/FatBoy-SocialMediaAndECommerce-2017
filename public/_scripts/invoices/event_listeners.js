$("#main_content").scroll(function () {
    if (!is_invoice_reading) {

        /**/
        if (can_i_read_more_invoices()) {
            is_invoice_reading = true;
            read_invoices();
        }
    }
});