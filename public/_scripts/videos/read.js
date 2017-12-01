function read_videos() {

    var crud_type = "read";
    var request_type = "GET";
    // var offset = get_num_of_photos_shown();


    var key_value_pairs = {
        read: "yes",
        shit: "shit"
    };



    var obj = new MyVideo(crud_type, request_type, key_value_pairs);
    obj.read();
}