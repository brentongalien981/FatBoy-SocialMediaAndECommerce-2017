function create_chat_msg() {
    var chat_msg = $("#chat-textarea").val();

    //
    if (chat_msg.trim().length <= 0) { return; }

    //
    var crud_type = "create";
    var request_type = "POST";

    var key_value_pairs = {
        create: "yes",
        message: chat_msg
    };

    var obj = new ChatMessage(crud_type, request_type, key_value_pairs);
    obj.create();

    // //
    // var chat_msg_el = document.createElement("p");
    // chat_msg_el.classList.add("user-chat-msg");
    // $(chat_msg_el).html(chat_msg);
    // $("#chat-wall").append(chat_msg_el);


    // post_chat_msg(chat_msg);
}

function post_chat_msg(chat_msg) {
    // AJAX
    var xhr = new XMLHttpRequest();

    var url = "<?php echo LOCAL . '/public/__controller/controller_chat.php'; ?>";
    xhr.open('POST', url, true);
    // You need this for AJAX POST requests.
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        // If ready..
        if (xhr.readyState == 4 && xhr.status == 200) {

            // If there's a successful response..
            if (xhr.responseText.trim().length > 0) {
                // TODO: LOG: console.log("chat message posted: " + xhr.responseText.trim());
                console.log("chat message posted: " + xhr.responseText.trim());
            } else {
            }

        }
    }


    //
    var post_key_value_pairs = "chat_msg=" + chat_msg;
    xhr.send(post_key_value_pairs);
}