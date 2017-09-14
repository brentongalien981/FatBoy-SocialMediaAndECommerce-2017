function manage_thread(user_id) {
    var crud_type = "create";
    var request_type = "POST";


    var key_value_pairs = {
        manage_thread: "yes",
        user_id: user_id
    };



    var obj = new ChatList(crud_type, request_type, key_value_pairs);
    obj.create();
}