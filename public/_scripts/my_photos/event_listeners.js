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
});





photos_container.addEventListener("scroll", function () {
    if (!is_ajax_reading) {

        prepare_load_more_photos();
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
    if (get_num_of_photos_shown() > 20 &&
        reference_for_loading_more_rel_pos <= 800) {
        console.log("**********************************");
        console.log("NUM_OF_PHOTOS > 20 && REFERENCE is <= 800");
        console.log("**********************************");
        // return;
        // users_container_section += 1;
        // is_ajax_reading = true;

        read_photos();
    }
}