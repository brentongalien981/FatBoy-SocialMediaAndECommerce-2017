function add_event_listeners_to_video_options_el(video_options_el) {

    //
    $(video_options_el).mouseover(function (event) {
        event.stopPropagation();
        attach_video_options_popup_el(this);
    });

    //
    $(video_options_el).mouseout(function (event) {
        event.stopPropagation();
        detach_video_options_popup_el(this);
    });
}

function detach_video_options_popup_el(video_options_el) {

    //
    video_options_popup_el_mouseout_handler = setTimeout(function () {
        $("#video-options-popup-el").css("display", "none");
    }, 1000);
}

function attach_video_options_popup_el(video_options_el) {

    //
    clearTimeout(video_options_popup_el_mouseout_handler);

    // Find the closest .my-video-header (up the DOM chain).
    var closest_video_header = $(video_options_el).closest(".my-video-header");

    $("#video-options-popup-el").insertAfter($(closest_video_header));

    $("#video-options-popup-el").css("display", "block");
}

function add_scroll_event_listener_to_main_content() {

    $('#main_content').scroll(function (event) {

        // set_video_options_popup_el_position
        event.stopPropagation();
        video_options_popup_el_mouseout_handler = setTimeout(function () {
            var scroll_top = parseInt($('#main_content').scrollTop());
            var new_top_pos = scroll_top + 50;
            $('#video-options-popup-el').css("margin-top", "-" + new_top_pos + "px");
            $('#video-options-popup-el').css("display", "none");
            $('#main_content').append($('#video-options-popup-el'));

        }, 1);


    });
}

function add_hover_event_listeners_to_video_options_popup_trigger_el() {

    //
    $(".video-options-popup-trigger-el").mouseover(function (event) {
        event.stopPropagation();
        // attach_video_options_popup_el(this);
        keep_video_options_popup_el_in_place(this);
    });

    //
    $(".video-options-popup-trigger-el").mouseout(function (event) {
        event.stopPropagation();
        detach_video_options_popup_el(null);
    });
}


function keep_video_options_popup_el_in_place(trigger_el) {
    //
    clearTimeout(video_options_popup_el_mouseout_handler);

    $("#video-options-popup-el").css("display", "block");
}