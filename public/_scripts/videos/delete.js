function delete_video() {

    var crud_type = "delete";
    var request_type = "POST";

    var video_id = get_currently_deleted_video_id();

    //
    set_loader_el(video_id, "We're just deleting your video..");

    // Temporarily hide the currently-deleted-video.
    $("#" + video_id).find("iframe").css("display", "none");

    // Remove the video-id prefix.
    video_id = video_id.substring(8); // Remove the "my-video" from my-video48

    // var video_title = $("#video-title-input-for-update").val();
    // var video_url = $("#video-url-input-for-update").val();




    var key_value_pairs = {
        delete: "yes",
        video_id: video_id
    };



    var obj = new MyVideo(crud_type, request_type, key_value_pairs);
    obj.delete();


}

function get_currently_deleted_video_id() {

    var currently_edited_video_el = $("#video-options-popup-el").closest(".my-videos");

    return $(currently_edited_video_el).attr("id");
}

function dom_remove_my_video(x_obj) {

    var video_id = x_obj.key_value_pairs.video_id;

    // To be safe before dom-removing the video,
    // detach the video-options-popup-el and the
    // update-video-form from the currently-deleted-my-video
    // and attach it the #main-content.
    $("#video-options-popup-el").css("display", "none");
    $("#main_content").append($("#video-options-popup-el"));
    $("#main_content").append($("#update-video-form"));


    $("#my-video" + video_id).remove();

}