$(window).resize(function () {
    set_widget_position();
});

$(window).scroll(function () {
    set_widget_position();
});

function set_widget_position() {

    var y_pos = 0 - parseInt($(window).scrollTop());
    var x_pos = 0 - parseInt($(window).scrollLeft());


    $("#b-widget").css("right", x_pos + "px");
    $("#b-widget").css("bottom", y_pos + "px");
}