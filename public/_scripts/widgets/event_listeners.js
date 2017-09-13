$(window).resize(function () {
    set_widget_position();
    // set_notifications_position();
});

$(window).scroll(function () {
    set_widget_position();
    // set_notifications_position();
});

function set_widget_position() {

    var y_pos = 0 - parseInt($(window).scrollTop());
    var x_pos = 0 - parseInt($(window).scrollLeft());


    $("#the-widget").css("right", x_pos + "px");
    $("#the-widget").css("bottom", y_pos + "px");
}

function set_notifications_position() {

    var y_pos = 70 - parseInt($(window).scrollTop());
    var x_pos = 0 - parseInt($(window).scrollLeft());


    $("#b-widget").css("right", x_pos + "px");
    $("#b-widget").css("bottom", y_pos + "px");
}