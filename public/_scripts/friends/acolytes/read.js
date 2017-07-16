function read_friendship_acolytes_records() {
    // TODO:REMINDER: Make this a parameter.
    var section = 1;

// Set up the necessary infos for this obj.
    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read: "yes",
        section: section
    };


    //
    var friendship_acolytes_obj = new FriendshipAcolyte(crud_type, request_type, key_value_pairs);
    friendship_acolytes_obj.read();
}