function read_my_shopping_notification_objs() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        section: 1
    };


    //
    var my_shopping_notification_obj = new NotificationMyShopping(crud_type, request_type, key_value_pairs);
    my_shopping_notification_obj.read();
}


function get_notification_for_invoice_item_status_update(notification) {
    var n = notification;
    var msg = "";

    // Bren's Store updated the item PS4 you bought to status "being shipped" on July 17, 2009. view
    msg += " <a class=''>";
    msg += n['seller_name'] + "'s Store";
    msg += "</a>";

    msg += " updated the item ";
    msg += "<a href='#'>";
    msg += n['item_name'];
    msg += "</a>";
    msg += " you bought to status ";
    msg += "'";
    msg += n['status_name'];
    msg += "'";
    msg += " (";
    msg += n['status_date']
    msg += ")";

    msg += " <a";
    msg += ">view</a>";

    //
    return msg;
}