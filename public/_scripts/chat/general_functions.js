function do_chat_message_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            $(".chat-msg-container").remove();
            populate_chat_wall(json);
            can_chat_msgs_fetch = true;
            break;
        case "create":
            // Clear the textarea.
            $("#chat-textarea").val("");
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            populate_chat_wall(json);
            break;
    }
}

function get_chat_msg_latest_date() {

    var chat_msgs = $(".chat-msg-container");
    var length = chat_msgs.length;

    var latest_chat_msg = chat_msgs[length - 1];
    var latest_date = $(latest_chat_msg).attr("date-posted");

    if (latest_chat_msg == null ||
        latest_date == null ||
        latest_date == "") {

        return "2010-09-11 10:54:45";
    }
    else {
        return latest_date;
    }
}

function scroll_chat_wall_to_bottom() {

    $("#chat-wall").scrollTop($("#chat-wall").prop("scrollHeight"));
}