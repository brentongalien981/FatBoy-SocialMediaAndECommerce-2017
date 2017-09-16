async function initialize_fetch_chat_msgs() {
    while (!can_chat_msgs_fetch) {
        await my_sleep(1000);
    }

    set_chat_msgs_fetcher();
}

function set_chat_msgs_fetcher() {
    // Get an update every second.
    chat_msgs_fetch_handler = setInterval(fetch_chat_msgs, 2000);
}

function fetch_chat_msgs() {
    var latest_chat_msg_date = get_chat_msg_latest_date();

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_chat_msg_date: latest_chat_msg_date
    };


    var obj = new ChatMessage(crud_type, request_type, key_value_pairs);
    obj.fetch();
}