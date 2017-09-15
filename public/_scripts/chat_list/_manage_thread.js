function manage_thread(button) {
    var crud_type = "create";
    var request_type = "POST";
    var user_id = $(button).attr("user-id");
    var user_name = $(button).attr("user-name");
    var profile_pic_src = $(button).attr("profile-pic-src");


    var key_value_pairs = {
        manage_thread: "yes",
        user_id: user_id,
        user_name: user_name,
        profile_pic_src: profile_pic_src
    };



    var obj = new ChatList(crud_type, request_type, key_value_pairs);
    obj.create();
}