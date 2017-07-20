function read_user_objs() {
// Set up the necessary infos for this x_notification
    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        section: 1,
        tae: "shit"
    };


    var user_obj_request = new User(crud_type, request_type, key_value_pairs);
    user_obj_request.read();
}