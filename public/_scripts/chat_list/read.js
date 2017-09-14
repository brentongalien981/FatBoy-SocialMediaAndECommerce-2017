function read_chat_list() {
    // FLAG
    if (is_chat_list_ajax_reading) { return; }
    is_chat_list_ajax_reading = true;

    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_chat_list_items();


    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        offset: offset
    };



    var obj = new ChatList(crud_type, request_type, key_value_pairs);
    obj.read();
}