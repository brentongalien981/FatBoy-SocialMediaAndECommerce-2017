function do_my_video_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_my_videos(json, crud_type);

            set_videos_fetcher();
            break;
        case "create":
            // window.alert("You've successfully added your video..");

            // Your video will be dom-displayed through ajax-fetch.
            break;
        case "update":
            window.alert("You've successfully updated your video..");

            var updated_video_title = x_obj.key_value_pairs.video_title;
            var updated_video_src = x_obj.key_value_pairs.video_url;

            reset_video_el(updated_video_title, updated_video_src);

            is_editing_video = false;
            break;
        case "delete":
            window.alert("You've successfully deleted your video..");

            //
            dom_remove_my_video(x_obj);
            break;
        case "fetch":

            display_my_videos(json, crud_type);
            break;
        case "patch":
            break;
    }
}

function display_my_videos(json, crud_type) {

    //
    var objs = json.objs;

    //
    for (i = 0; i < objs.length; i++) {

        //
        var obj = objs[i];

        //
        var video_el = get_video_el(obj);


        if (crud_type == "read") {
            /* Append the obj-el. */
            $("#main_content").append($(video_el));
        }
        else {
            // Prepend the obj-el.
            var ref_el_class_name = "my-videos";
            mcn_prepend_el(video_el, ref_el_class_name);
        }

    }


    // /* Re-append the reference el. */
    // $("#main_content").append($("#read-more-store-items-initiator-reference"));

}

function get_video_el(obj) {

    var video_el = document.createElement("iframe");
    $(video_el).addClass("timeline_iframe_video_div");
    $(video_el).attr("src", obj.src);
    $(video_el).attr("frameborder", "0");
    $(video_el).attr("gesture", "media");
    $(video_el).attr("allowfullscreen", "");

    //
    var my_video_header = get_my_video_header(obj);


    //
    var video_container = document.createElement("div");
    video_container.id = "my-video" + obj.id;
    $(video_container).addClass("video-container my-videos");
    $(video_container).attr("created-at", obj.created_at);


    //
    $(video_container).append($(my_video_header));
    $(video_container).append($(video_el));


    //
    return video_container;
}

function mcn_prepend_el(video_el, ref_el_class_name) {

    var ref_el = $("." + ref_el_class_name)[0];

    // $(ref_el).prepend($(video_el));
    $(video_el).insertBefore($(ref_el));
}

function do_my_video_pre_after_effects(class_name, crud_type, json, x_obj) {

    //
    switch (crud_type) {
        case "read":
            break;
        case "create":
            break;
        case "update":

            //
            unset_loader_el();

            // Re-show the update-video-form.
            $("#update-video-form").css("display", "block");

            //
            is_video_ajax_updating = false;
            break;
        case "delete":

            //
            unset_loader_el();

            // Re-show the currently-deleted-video.
            var video_id = x_obj.key_value_pairs.video_id;
            $("#my-video" + video_id).find("iframe").css("display", "block");

            //
            is_video_ajax_deleting = false;
            break;
        case "fetch":
            //
            are_my_videos_fetching = false;
            break;
        case "patch":
            break;
    }


    // If the response is not successful..
    if (json === null || !json.is_result_ok) {
    } else if (json.is_result_ok) {
        // Else if it's successful..
    }
}


