function read_app_settings() {

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes"
    };


    var obj = new AppSetting(crud_type, request_type, key_value_pairs);
    obj.read();
}

function set_app(json) {
    var o = json.objs;
    var notifications_is_maximized = o["notifications_is_maximized"];
    var chat_list_is_maximized = o["chat_list_is_maximized"];
    var chat_pod_is_maximized = o["chat_pod_is_maximized"];

    (notifications_is_maximized == "true") ? maximize_notifications_window() : minimize_notifications_window();
    (chat_list_is_maximized == "true") ? maximize_chat_list_window() : minimize_chat_list_window();
    (chat_pod_is_maximized == "true") ? maximize_chat_pod_window() : minimize_chat_pod_window();
}