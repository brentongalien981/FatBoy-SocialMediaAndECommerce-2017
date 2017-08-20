function set_solo_view_container() {

    var the_body = document.getElementById("the_body");

    $('#solo_view_container').css("display", "none");

    $('#solo_view_container').css("width", the_body.scrollWidth + "px");
    $('#solo_view_container').css("height", the_body.scrollHeight + "px");

    $('#solo_view_container').css("display", "block");
}