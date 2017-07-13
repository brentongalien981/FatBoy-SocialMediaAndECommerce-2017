function read_friendship_suggestions_objs() {
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
    var friendship_suggestions_obj = new FriendshipSuggestion(crud_type, request_type, key_value_pairs);
    friendship_suggestions_obj.read();
}