$(".keyboard-keys").click(function (event) {
    event.stopPropagation();
    clicked_key = this;

    //
    set_chat_textarea($(this).html());

    //
    $(clicked_key).css("background-color", "rgb(234, 255, 206)");
    $(clicked_key).css("box-shadow", "0 0 20px rgb(150, 150, 150)");
    // $(clicked_key).css("zoom", "3");

    setTimeout(animate_key, 150);
});

$(".keyboard-keys").mouseover(function () {
    $(this).css("background-color", "rgb(160, 160, 160)");
});

$(".keyboard-keys").mouseout(function () {
    $(this).css("background-color", "rgb(130, 130, 130)");
});

$("#send-chat-button").click(function () {
    if (!is_chat_thread_id_set) {
        window.alert("Select first your friend you wanna chat with :)");
        return;
    }

    create_chat_msg();
});