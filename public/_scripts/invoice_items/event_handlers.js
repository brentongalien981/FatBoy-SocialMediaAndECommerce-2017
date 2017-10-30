function add_listeners_to_invoice_item_status_select_el(status_select_el) {

    /**/
    $(status_select_el).change(function () {

        /**/
        var is_update_sure = window.confirm("Are you sure about the\nstatus update of this item?");



        /**/
        var old_invoice_item_status_id = $(this).attr("old-value");
        var new_invoice_item_status_id = $(this).val();

        /**/
        // Revert back to its original value.
        $(this).val(old_invoice_item_status_id);

        /**/
        if (!is_update_sure) {
            return;
        }


        /* Remove the "selected" attribute from all of the <option>s in this <select>. */
        $(this).find("option").removeAttr("selected");




        /* Get the invoice-id based on the invoice-container-el. */
        var the_invoice_el = $(this).closest(".invoices");
        // Remove the "invoice" part from "invoice782jlkdsf8";
        the_invoice_id = $(the_invoice_el).attr("id").substring(7);


        /* Reference the sales-summary-table where this select-el is in. */
        var the_sales_summary_table = $(this).closest(".invoice-item-details");


        /* Get the invoice-item-id from the <td> that holds that value. */
        var the_invoice_item_id = $(the_sales_summary_table).find(".invoice-item-id-data").html();



        /**/
        create_my_shopping_notification(old_invoice_item_status_id, new_invoice_item_status_id, the_invoice_item_id, the_invoice_id);
        // window.alert("old_invoice_item_status_id " + old_invoice_item_status_id);
        // window.alert("new_invoice_item_status_id " + new_invoice_item_status_id);
        // window.alert("the_invoice_item_id " + the_invoice_item_id);
    });
}