function read_profile() {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        shit: "shit",
        read : "yes"
    };


    var obj = new Profile(crud_type, request_type, key_value_pairs);
    obj.read();
}