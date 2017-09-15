function update_the_cursor_position_value() {
    var current_cursor_position = $('#chat-textarea').prop("selectionStart");

    document.getElementById("input_cursor_position").value = current_cursor_position;
}

function get_the_cursor_position_value() {
    return document.getElementById("input_cursor_position").value;
}

function read_chat_msgs() {
    // var latest_notification_date = get_notification_with_latest_date("NotificationFriendship");

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes"
    };


    var obj = new ChatMessage(crud_type, request_type, key_value_pairs);
    obj.read();
}

async function initialize_read_chat_msgs() {
    while (!is_chat_thread_id_set) {
        await my_sleep(200);
    }

    read_chat_msgs();
}

function populate_chat_wall(json) {
    // return;
    var chat_msgs = json.objs;

    var i = 0;
    i = parseInt(i);

    for (; i < chat_msgs.length; i+=1) {
        var c = chat_msgs[i];

        //
        var chat_msg_container = document.createElement("div");
        chat_msg_container.classList.add("chat-msg-container");


        //
        var user_pic = null;
        if (c["chatter_user_id"] == json.actual_user_id) {


            var user_pic_src = $("#profile_pic").attr("src");

            if (user_pic_src == null) {
                user_pic = document.createElement("i");
                $(user_pic).attr("class", "fa fa-user-circle-o");
            }
            else {
                user_pic = document.createElement("img");
                $(user_pic).attr("src", user_pic_src);
            }

        }
        else {
            var chatter_presentation_info = get_chat_friend_info(c["chatter_user_id"]);
            var cpi = chatter_presentation_info;



            if (cpi.profile_pic_src == "") {
                user_pic = document.createElement("i");
                user_pic.classList.add("fa");
                user_pic.classList.add("fa-user-circle-o");
            }
            else {
                user_pic = document.createElement("img");
                $(user_pic).attr("src", cpi.profile_pic_src);
            }

            // $(user_pic).attr("class", "fa fa-user-circle-o");
        }

        user_pic.classList.add("chat-msg-photo");


        //
        var chat_msg = document.createElement("p");
        $(chat_msg).html(c["message"]);
        chat_msg.classList.add("chat-msg");

        //
        if (c["chatter_user_id"] == json.actual_user_id) {
            chat_msg_container.classList.add("user-chat-msg-container");
            // chat_msg_container.id = "putangina";
            $(chat_msg_container).append(user_pic);
            $(chat_msg_container).append(chat_msg);
        }
        else {

            $(chat_msg_container).append(chat_msg);

            $(chat_msg_container).append(user_pic);

        }


        $("#chat-wall").append(chat_msg_container);
    }

}