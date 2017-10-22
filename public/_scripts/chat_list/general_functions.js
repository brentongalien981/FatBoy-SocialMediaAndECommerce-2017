function get_num_of_chat_list_items() {
    return $(".chat-list-items").length;
}

function do_chat_list_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            populate_chat_list_container(json.objs, class_name, crud_type, x_obj, json);

            if (json.chat_friend_user_id != null) {
                var chat_friend_info = get_chat_friend_info(json.chat_friend_user_id)

                var c = chat_friend_info;
                if (c != null) {

                    set_widget_status_bar(c.user_name, c.profile_pic_src);
                    is_chat_thread_id_set = true;
                    // read_chat_msgs();
                }

            }

            break;
        case "create":
            // This is actually for the manage_thread functionality.
            is_chat_thread_id_set = true;

            var user_name = x_obj.key_value_pairs["user_name"];
            var profile_pic_src = x_obj.key_value_pairs["profile_pic_src"];

            set_widget_status_bar(user_name, profile_pic_src);
            read_chat_msgs();

            show_chat_pod();
            scroll_chat_wall_to_bottom();
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}

function populate_chat_list_container(objs, class_name, crud_type, x_obj, json) {

    //
    for (i = 0; i < objs.length; i++) {

        var o = objs[i];

        // Build the new entry.
        var item = document.createElement("div");
        item.classList.add("chat-list-items");

        var img = null;
        var profile_pic_src = null;
        if (o["profile_pic_src"] == null) {
            img = document.createElement("i");
            img.classList.add("fa");
            img.classList.add("fa-user-circle-o");
            $(img).css("font-size", "30px");

            profile_pic_src = "";
        }
        else {
            img = document.createElement("img");
            $(img).attr("src", o["profile_pic_src"]);

            profile_pic_src = o["profile_pic_src"];
        }

        img.classList.add("chat-list-item-img");


        var name = document.createElement("h5");
        name.classList.add("chat-list-item-name");
        $(name).html(o["user_name"]);

        var button = document.createElement("button");
        button.classList.add("chat-list-item-button");
        $(button).attr("user-id", o["user_id"]);
        $(button).attr("user-name", o["user_name"]);
        $(button).attr("profile-pic-src", profile_pic_src);
        $(button).html("chat");

        //
        item.appendChild(img);
        item.appendChild(name);
        item.appendChild(button);

        //
        add_listener_to_chat_button(button);



        // Append the new entry.
        $("#chat-list").append($(item));
    }


    // Set the chat-list's pseudo-visibility.
    if (get_num_of_chat_list_items() == 0) {
        $("#empty_chat_list_msg").css("display", "block");
        $("#chat_list").css("display", "none");
    }
    else {
        $("#empty_chat_list_div").css("display", "none");
        $("#chat_list").css("display", "block");
    }


    // FLAG
    // Set up for the next "load more".
    is_chat_list_ajax_reading = false;
}