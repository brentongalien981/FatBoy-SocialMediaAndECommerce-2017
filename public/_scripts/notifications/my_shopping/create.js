function create_my_shopping_notification(old_invoice_item_status_id, new_invoice_item_status_id, the_invoice_item_id) {
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create : "yes",
        old_invoice_item_status_id: old_invoice_item_status_id,
        new_invoice_item_status_id: new_invoice_item_status_id,
        the_invoice_item_id: the_invoice_item_id,
        the_invoice_id: the_invoice_id
    };

    var obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
    obj.create()
}