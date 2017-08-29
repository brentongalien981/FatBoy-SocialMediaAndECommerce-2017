function hide_element(el) {
    $(el).css("display", "none");
}

function show_element(el, display) {
    $(el).css("display", display);
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

function clear_error_labels() {
    $('.error_msg').html("error");
    $('.error_msg').css("visibility", "hidden");
}


