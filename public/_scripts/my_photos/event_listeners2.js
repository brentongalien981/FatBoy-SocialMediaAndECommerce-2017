/* Events */
$('#cancel_photo_edit_button').click(function () {

    show_element($('#add_photo_link'), "inline");


    // b_remove_animation($('#edit_photo_form').get(0), "fadeInDown");
    // b_add_animation($('#edit_photo_form').get(0), "fadeOutUp");
    //
    // setTimeout(function () {
    //     hide_element($('#edit_photo_form'));
    // }, 500);

    b_animate_hide_edit_photo_form();
});

$('#edit_photo_button').click(function () {
    // hide_element($('#edit_photo_form'));
    // show_element($('#add_photo_link'), "inline");

    update_photo();
    // window.alert("TODO:EVENT:CLICK: edit_photo_button.");
});





/* Functions */
function add_click_listener_to_edit_icon(icon) {

    $(icon).click(function (event) {

        event.stopPropagation();
        hide_element($('#add_photo_form'));
        hide_element($('#add_photo_link'));
        show_element($('#edit_photo_form'), "block");


        b_remove_animation($('#edit_photo_form').get(0), "fadeOutUp");
        b_add_animation($('#edit_photo_form').get(0), "fadeInDown");


        //
        populate_edit_form(this);
    });
}

function add_click_listener_to_delete_icon(icon) {
    $(icon).click(function (event) {

        event.stopPropagation();


        var is_deletion_sure = confirm("Are you sure you wanna delete this photo?");

        if (is_deletion_sure == true) {
            // Delete the damn thing.
            var current_photo_container = this.parentElement.parentElement.parentElement;
            var current_photo = current_photo_container.childNodes[0];
            var photo_id = $(current_photo).attr("id");
            photo_id = photo_id.substring(5); // Remove the "photo" from photo113

            delete_photo(photo_id);
        }
    });
}

