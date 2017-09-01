$('#cancel_create_post_button').click(function (event) {
    event.stopPropagation();

    hide_create_post_form();
});

function hide_create_post_form() {
    show_element($('#create_post_link'), "inline");


    b_remove_animation($('#create_post_form').get(0), "fadeInDown");
    b_add_animation($('#create_post_form').get(0), "fadeOutUp");

    setTimeout(function () {
        hide_element($('#create_post_form'));
    }, 500);
}

$('#create_post_link').click(function (event) {
    event.stopPropagation();

    // hide_element($('#edit_photo_form'));
    hide_element($('#create_post_link'));
    show_element($('#create_post_form'), "block");


    b_remove_animation($('#create_post_form').get(0), "fadeOutUp");
    b_add_animation($('#create_post_form').get(0), "fadeInDown");


    //
    // $('#add_photo_form').css("display", "block");
    // $(this).css("display", "none");
    //
    // b_remove_animation($('#add_photo_form').get(0), "fadeOutUp");
    // b_add_animation($('#add_photo_form').get(0), "fadeInDown");
});

function show_element(el, display) {
    $(el).css("display", display);
}

function hide_element(el) {
    $(el).css("display", "none");
}

/**
 *
 * @param el element
 * @param a animation
 */
function b_add_animation(el, a) {
    el.classList.add(a);


}

/**
 *
 * @param el element
 * @param a animation
 */
function b_remove_animation(el, a) {
    el.classList.remove(a);
}