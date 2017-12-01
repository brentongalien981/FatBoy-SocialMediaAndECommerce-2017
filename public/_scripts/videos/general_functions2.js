function get_my_video_header(obj) {
    //
    var video_header = document.createElement("div");
    $(video_header).addClass("my-video-header");

    //
    var video_title = document.createElement("h4");
    $(video_title).html(obj.title);
    $(video_title).addClass("my-video-title");

    //
    var video_options = document.createElement("div");
    $(video_options).addClass("my-video-options");
    $(video_options).addClass("fa fa-sliders");

    //
    add_event_listeners_to_video_options_el(video_options);

    //
    $(video_header).append($(video_title));
    $(video_header).append($(video_options));

    //
    return video_header;
}


function reset_video_el(updated_video_title, updated_video_src) {

    //
    var currently_edited_video_el = $("#update-video-form").closest(".my-videos");


    // Get the contents of the my-video-container.
    var video_title_el = $(currently_edited_video_el).find(".my-video-title");
    var video_header_el = $(currently_edited_video_el).find(".my-video-header");
    var video_el = $(currently_edited_video_el).find(".timeline_iframe_video_div");


    // Set the video-detail-contents. This is particularly used after a
    // successful ajax-update.
    if (updated_video_title != null) {
        $(video_title_el).html(updated_video_title);
    }

    if (updated_video_src != null) {
        $(video_el).attr("src", updated_video_src);
    }


    // Re-show the contents of the my-video.
    $(video_header_el).css("display", "block");
    $(video_el).css("display", "block");


    // Hide this.
    $("#main-content").append($("#update-video-form"));
    $("#update-video-form").css("display", "none");
}