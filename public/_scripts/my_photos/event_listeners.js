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

        reset_captions();
    }
});


$('#solo_view_container').click(function () {

    $(this).css("display", "none");
});


$('#previous-solo-button').click(function (event) {

    event.stopPropagation();

    //
    var old_solo_img = solo_img_container.childNodes[0].childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "previous")[0];


    //
    show_solo_img(referenced_img);

    // add_listener_to_solo_link_holder();
});


$('#next-solo-button').click(function (event) {
    event.stopPropagation();

    //
    var old_solo_img = solo_img_container.childNodes[0].childNodes[0];
    var old_stack_index = old_solo_img.getAttribute("referencing-stack-index");

    // New referenced img.
    var referenced_img = get_referenced_img(old_stack_index, "next")[0];


    //
    show_solo_img(referenced_img);

    // add_listener_to_solo_link_holder();
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


// function add_click_listener(img) {
//     $(img).click(function () {
//         show_solo_img(this);
//         // add_listener_to_solo_link_holder();
//     });
// }

function add_click_listener_to_caption(caption) {

    $(caption).click(function () {

        var the_img = caption.parentElement.childNodes[0];

        if (the_img != null &&
            $(the_img).is("img")) {
            show_solo_img(the_img);
        }
    });
}






function add_mouseleave_listener(an_img) {
    // $(an_img).mouseleave(function (event) {
    //     // event.stopPropagation();
    //
    //     var the_caption = an_img.parentElement.childNodes[0];
    //     remove_caption(the_caption);
    // });

    $(an_img).mouseleave(function (event) {
        // event.stopPropagation();
        // event.stopImmediatePropagation();
        console.log("EVENT: img's mouseleave");
        // return;

        var the_caption = an_img.parentElement.childNodes[0];


        remove_caption(the_caption);
        remove_icons(the_caption);
        // is_mouse_on_photo = false;
        // hovered_caption = the_caption;
    });
}




function add_mouseenter_listener(an_img) {

    $(an_img).mouseenter(function (event) {

        // event.stopPropagation();
        // event.stopImmediatePropagation();
        // is_mouse_on_photo = true;

        // show_caption(this);
        // return;
        show_caption(this);


        //
        //
        //
        // if (just_previously_hovered_img_id == null ||
        //     just_previously_hovered_img_id != this.id) {
        //     show_caption(this);
        //     console.log("EVENT: mouseenter " + mouseenter_counter);
        //     ++mouseenter_counter;
        //
        //     hovered_img = this;
        //
        //     just_previously_hovered_img_id = this.id;
        // }

        //
        // if (hovered_img.id == this.id) { return; }


    });

    // $(an_img).mouseover(function (event) {
    //     // event.stopPropagation();
    //     // event.stopImmediatePropagation();
    //     is_mouse_on_photo = true;
    //     hovered_img = this;
    //     // show_caption(this);
    // });
}