$('#add_photo_link').click(function () {
    $('#add_photo_form').css("display", "block");
    $(this).css("display", "none");
});


$('#cancel_photo_creation_button').click(function () {
    $('#add_photo_form').css("display", "none");
    $('#add_photo_link').css("display", "inline");
});


$('#create_photo_button').click(function () {
    // $('#add_photo_form').css("display", "none");
    // $('#add_photo_link').css("display", "inline");
    // console.log("embed_code: " + $('#embed_code').val());
    create_photo();
});


$('#load_more_button').click(function () {
    read_photos();

    $(this).css("display", "none");
    is_initial_read_done = true;
});


photos_container.addEventListener("scroll", function () {
    if (!is_ajax_reading) {

        prepare_load_more_photos();
    }
});


$('#solo_view_container').click(function () {
    $(this).css("display", "none");
});


$('#previous-solo-button').click(function (event) {
    // $('#solo_view_container').css("display", "block");
    event.stopPropagation();
    window.alert("z-index: " + $(this).css("zIndex"));
});


$('#next-solo-button').click(function (event) {
    // $('#solo_view_container').css("display", "block");
    event.stopPropagation();
    window.alert("z-index: " + $(this).css("zIndex"));
});


$(window).resize(function () {

    // if the solo_view_container is visible..
    if ($('#solo_view_container').css("display") == "block") {
        set_solo_view_container();
    }

});


/* Functions */
// var photos_container_height = photos_container.offsetHeight;
// var photos_container_bounds = photos_container.getBoundingClientRect();

function prepare_load_more_photos() {
    // Boundaries of the sides of the reference.
    var reference_for_loading_more_bounds = reference_for_loading_more.getBoundingClientRect();
    var photos_container_bounds = photos_container.getBoundingClientRect();


    // reference_for_loading_more's relative position to the photos_container.
    var reference_for_loading_more_rel_pos = reference_for_loading_more_bounds.top - photos_container_bounds.top - photos_container.scrollTop;


    // TODO:LOG
    console.log("REL POS: " + reference_for_loading_more_rel_pos);


    //
    if (is_initial_read_done &&
        reference_for_loading_more_rel_pos <= 1400) {
        console.log("**********************************");
        console.log("NUM_OF_PHOTOS > initial_num_of_photos_shown && REFERENCE is <= 1400");
        console.log("**********************************");
        // return;
        // users_container_section += 1;
        // is_ajax_reading = true;

        read_photos();
    }
}


function add_click_listener(img) {
    $(img).click(function () {
        // window.alert("a photo is clicked");


        // Create the <img>
        var solo_img = document.createElement("img");
        solo_img.setAttribute("referencing-photo-id", this.id);
        solo_img.setAttribute("referencing-stack-index", this.getAttribute("stack-index"));
        solo_img.setAttribute("src", this.src);

        var raw_width = this.getAttribute("raw-width");
        var raw_height = this.getAttribute("raw-height");
        var w = raw_width;
        var h = raw_height;

        if (raw_width > 1100) {
            var r = raw_width / raw_height;
            var w = 1100;
            var h = w / r;
        }

        solo_img.setAttribute("width", w);
        solo_img.setAttribute("height", h);


        //
        clear_solo_img_container();
        solo_img_container.appendChild(solo_img);

        // window.alert("the_body.scrollWidth: " +the_body.scrollWidth);

        set_solo_view_container();
    });
}