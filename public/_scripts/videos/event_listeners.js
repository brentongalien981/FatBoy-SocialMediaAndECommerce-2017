$('#add_video_link').click(function (event) {
    event.stopPropagation();

    // hide_element($('#edit_photo_form'));
    hide_element($('#add_video_link'));
    show_element($('#add_video_form'), "block");

    b_remove_animation($('#add_video_form').get(0), "fadeOutUp");
    b_add_animation($('#add_video_form').get(0), "fadeInDown");
});

//
$('#cancel_video_creation_button').click(function () {

    show_element($('#add_video_link'), "initial");


    b_remove_animation($('#add_video_form').get(0), "fadeInDown");
    b_add_animation($('#add_video_form').get(0), "fadeOutUp");

    setTimeout(function () {
        hide_element($('#add_video_form'));
    }, 500);
});


$('#create_video_button').click(function () {
    create_video();
});

$("#edit-video-button").click(function () {

    //
    if (is_editing_video) {
        window.alert("You're currently editing another video. Finalized that first before editing a new one.");
        return;
    }

    if (is_video_ajax_deleting) {
        window.alert("Please wait.. We're currently deleting your video..");
        return;
    }

    //
    is_editing_video = true;

    prepare_video_for_editing();
});

$("#delete-video-button").click(function () {

    if (is_editing_video) {
        window.alert("Please finalized your editing first before you can delete a video..");
        return;
    }

    if (is_video_ajax_updating) {
        window.alert("Please wait.. We're currently updating your video.");
        return;
    }

    //
    is_video_ajax_deleting = true;

    // // Temporarily hide the update-video-form.
    // $("#update-video-form").css("display", "none");

    //
    delete_video();
});


$("#update-video-button").click(function () {

    if (!is_editing_video) { return; }

    if (is_video_ajax_updating) {
        window.alert("Please wait.. We're just updating your other awesome video..");
        return;
    }

    if (is_video_ajax_deleting) {
        window.alert("Please wait.. We're currently deleting your video..");
        return;
    }

    //
    is_video_ajax_updating = true;

    // Temporarily hide the update-video-form.
    $("#update-video-form").css("display", "none");

    //
    update_video();

});


$("#cancel-update-video-button").click(function () {

    if (is_video_ajax_updating) {
        window.alert("Please wait.. We're just updating your awesome video..");
        return;
    }

    is_editing_video = false;
    reset_video_el();
});
