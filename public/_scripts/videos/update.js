function update_video() {

    var crud_type = "update";
    var request_type = "POST";

    var video_id = get_currently_edited_video_id();

    //
    set_loader_el(video_id, "We're just updating your video..");

    // Remove the video-id prefix.
    video_id = video_id.substring(8); // Remove the "my-video" from my-video48

    var video_title = $("#video-title-input-for-update").val();
    var video_url = $("#video-url-input-for-update").val();




    var key_value_pairs = {
        update: "yes",
        video_id: video_id,
        video_title: video_title,
        video_url: video_url
    };



    var obj = new MyVideo(crud_type, request_type, key_value_pairs);
    obj.update();


}

function get_currently_edited_video_id() {

    var currently_edited_video_el = $("#update-video-form").closest(".my-videos");

    return $(currently_edited_video_el).attr("id");
}

function prepare_video_for_editing() {

    var currently_edited_video_el = $("#edit-video-button").closest(".my-videos");

    // Get the contents of the my-video-container.
    var video_title_el = $(currently_edited_video_el).find(".my-video-title");
    var video_header_el = $(currently_edited_video_el).find(".my-video-header");
    var video_el = $(currently_edited_video_el).find(".timeline_iframe_video_div");

    // Temporarily hide the my-video contents while editing.
    $(video_header_el).css("display", "none");
    $(video_el).css("display", "none");

    //
    var video_title = $(video_title_el).html();
    var video_src = $(video_el).attr("src");
    set_update_video_form(currently_edited_video_el, video_title, video_src);


}

function set_update_video_form(currently_edited_video_el, video_title, video_src) {

    //
    $(currently_edited_video_el).append($("#update-video-form"));
    $("#update-video-form").css("display", "block");

    // Populate the input fields.
    $("#video-title-input-for-update").val(video_title);
    $("#video-url-input-for-update").val(video_src);
}