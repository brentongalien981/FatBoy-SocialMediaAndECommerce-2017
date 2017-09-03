$('#cancel_create_post_button').click(function (event) {
    event.stopPropagation();

    hide_create_post_form();
});

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


$('.rate-bar-hover-trigger').mouseover(function (event) {
    event.stopPropagation();
    clearTimeout(the_rate_bar_mouseout_handler);
    $('#the-rate-bar').css("display", "none");




    // If the hovered element is a rate-pseudo-button itself,
    // then just append the-rate-bar directly.
    // Else, if it's not, traverse up back the DOM until I find
    // the proper rate-pseudo-button. Then append the-rate-bar.
    if (this.classList.contains("rate-pseudo-button")) {
        // $('#the-rate-bar').insertAfter($('#rate-button'));
        $('#the-rate-bar').insertAfter($(this));
    }
    else {
        var the_rate_pseudo_button = $(this).closest(".rate-pseudo-button");
        $('#the-rate-bar').insertAfter($(the_rate_pseudo_button));
    }

    $('#the-rate-bar').css("display", "inline-block");

});

$('.rate-bar-hover-trigger').mouseout(function (event) {
    event.stopPropagation();
    the_rate_bar_mouseout_handler = setTimeout(function () {
        $('#the-rate-bar').css("display", "none");
    }, 1000);


});

$('#main_content').scroll(function (event) {
    // return;
    event.stopPropagation();
    the_rate_bar_mouseout_handler = setTimeout(function () {
        var scroll_top = parseInt($('#main_content').scrollTop());
        $('#the-rate-bar').css("margin-top", "-" + scroll_top + "px");
        $('#the-rate-bar').css("display", "none");
        $('#main_content').append($('#the-rate-bar'));
        // $('#main_content').append($('#the-rate-bar'));

    }, 1);
});

$('.rate-option').click(function () {
    var rate_value = $(this).attr("rate-value");

    var response_bar = $(this).closest(".b-post-response-bar");
    var rateable_item_id = $(response_bar).attr("rateable-item-id");

    update_rateable_item(rateable_item_id, rate_value);
});
