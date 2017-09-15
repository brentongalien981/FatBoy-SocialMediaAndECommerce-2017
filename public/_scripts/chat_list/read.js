function read_chat_list() {
    // FLAG
    if (is_chat_list_ajax_reading) { return; }
    is_chat_list_ajax_reading = true;

    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_chat_list_items();


    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        offset: offset
    };



    var obj = new ChatList(crud_type, request_type, key_value_pairs);
    obj.read();
}

function set_widget_status_bar(user_name, profile_pic_src) {


    var status_content = "<h5>Chatting with</h5>";
    if (profile_pic_src == "") {
        status_content += "<i class='fa fa-user-circle-o widget-status-bar-img'></i>";
    }
    else {
        status_content += "<img class='widget-status-bar-img' src='" + profile_pic_src + "'>";
    }

    status_content += "<h5>" + user_name.substring(0, 10) + "..</h5>";

    $("#widget-status-bar").html(status_content);
}

function get_chat_friend_info(chat_friend_user_id) {
    var chat_buttons = $(".chat-list-item-button");
    var the_button = null;
    var user_info = null;

    for (i = 0; i < chat_buttons.length; i++) {
        if ($(chat_buttons[i]).attr("user-id") == chat_friend_user_id) {
            the_button = chat_buttons[i];

            // var car = {type:"Fiat", model:"500", color:"white"};
            user_info = {
                user_name: $(the_button).attr("user-name"),
                profile_pic_src: $(the_button).attr("profile-pic-src")
            };

            return user_info;
        }
    }
}