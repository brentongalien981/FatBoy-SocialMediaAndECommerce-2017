$(".keyboard-keys").click(function () {
    clicked_key = this;

    //
    set_chat_textarea($(this).html());

    //
    $(clicked_key).css("background-color", "rgb(234, 255, 206)");
    $(clicked_key).css("box-shadow", "0 0 20px rgb(150, 150, 150)");
    // $(clicked_key).css("zoom", "3");

    setTimeout(animate_key, 150);
});

function animate_key() {
    $(clicked_key).css("background-color", "rgb(240, 240, 240)");
    $(clicked_key).css("box-shadow", "none");

}