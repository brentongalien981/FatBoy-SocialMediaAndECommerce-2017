function read_invoice_items(invoice_id) {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        invoice_id: invoice_id
    };


    var obj = new InvoiceItem(crud_type, request_type, key_value_pairs);
    obj.read();
}