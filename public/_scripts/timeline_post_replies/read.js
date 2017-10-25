function read_timeline_post_replies(post_id) {
    var crud_type = "read";
    var request_type = "GET";

    var key_value_pairs = {
        read : "yes",
        timeline_post_id: post_id
    };


    var obj = new TimelinePostReply(crud_type, request_type, key_value_pairs);
    obj.read();
}