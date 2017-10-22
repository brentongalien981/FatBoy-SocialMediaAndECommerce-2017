function read_timeline_posts() {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes"
    };


    var obj = new TimelinePost(crud_type, request_type, key_value_pairs);
    obj.read();
}