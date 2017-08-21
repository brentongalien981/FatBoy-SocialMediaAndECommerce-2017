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

    event.stopPropagation();

    //
    var old_solo_img = solo_img_container.childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "previous")[0];


    //
    show_solo_img(referenced_img);

});


$('#next-solo-button').click(function (event) {
    event.stopPropagation();

    //
    var old_solo_img = solo_img_container.childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "next")[0];


    //
    show_solo_img(referenced_img);
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
        show_solo_img(this);
    });
}