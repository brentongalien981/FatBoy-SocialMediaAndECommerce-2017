function do_chat_message_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            $(".chat-msg-container").remove();
            populate_chat_wall(json);
            break;
        case "create":
            // Clear the textarea.
            $("#chat-textarea").val("");
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}