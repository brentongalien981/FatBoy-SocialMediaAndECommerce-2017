function read_friendship_muses_records() {
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
    var friendship_muses_obj = new FriendshipMuse(crud_type, request_type, key_value_pairs);
    friendship_muses_obj.read();
}