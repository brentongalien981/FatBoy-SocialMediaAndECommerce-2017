function do_photos_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":

            // prepare_users_container(class_name);
            // var container = get_users_container(class_name);
            //
            // //
            populate_photos_container(json.photos, class_name, crud_type, x_obj);
            break;
        case "create":
            //
            clear_photos_container();
            read_photos();
            clear_add_photo_form();
            clear_error_labels();
            break;
        case "update":
            dom_update_element(x_obj);
            clear_edit_photo_form();
            b_animate_hide_edit_photo_form();


            break;
        case "delete":
            clear_photos_container();
            read_photos();

            break;
    }
}


/**
 * @credt stackoverflow.com
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function get_random_int(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}


/**
 * Of those photos to be displayed in a row, find which has the largest height.
 * Set that as the maximum reference height.
 */
function get_max_ref_height(photo_embed_codes, num_of_photos) {
    var max_height = -1;
    var temp_counter_index = counter_index + num_of_photos;

    for (i = 0; i < num_of_photos; i++) {

        if (photo_embed_codes[temp_counter_index] == null) {
            break;
        }

        var embed_code = photo_embed_codes[temp_counter_index];
        ++temp_counter_index;

        var h = embed_code['height'];

        if (h >= max_height) {
            max_height = h;
        }
    }

    return max_height;
}


function populate_photos_container(photos, class_name, crud_type, x_obj) {

    //
    for (; counter_index < photos.length;) {
        var p = photos[i];


        //
        display_row_of_photos(photos);


        // Create a horizontal margin every img row container.
        // uki
        var horizontal_divider = document.createElement("div");
        horizontal_divider.classList.add("horizontal_divider");
        photos_container.appendChild(horizontal_divider);

        ++num_of_horizontal_dividers;


        // Update the reference_for_loading_more element.
        photos_container.appendChild(reference_for_loading_more);
    }

    // Reset the counter_index.
    counter_index = 0;

    // FLAG
    // Set up for the next "load more".
    is_ajax_reading = false;
}


function display_row_of_photos(photo_embed_codes) {
    //num_of_photos_in_row
    var num_of_photos_in_row = get_random_int(2, 4);

    //
    var max_ref_height = get_max_ref_height(photo_embed_codes, num_of_photos_in_row);

    // array of photos in one row.
    var photos_to_be_displayed = [];


    // Set the attributes of all the photos to be displayed
    // in the row container
    for (i = 0; i < num_of_photos_in_row; i++) {
        // If there's no more available photo_embed_code remaining
        // in the array, then break off the loop.
        if (photo_embed_codes[counter_index] == null) {
            break;
        }


        //uki
        var a_photo_to_be_displayed = get_the_photo(photo_embed_codes[counter_index], max_ref_height);


        //
        photos_to_be_displayed[i] = a_photo_to_be_displayed;


        //
        ++counter_index;
    }


    // Calculate the total reference width of all the photos.
    var total_reference_width = 0;
    for (i = 0; i < photos_to_be_displayed.length; i++) {
        total_reference_width += photos_to_be_displayed[i].reference_width;
    }


    /*  Display the row images. */

    // Now, all photos in that row container have their raw dimensions.
    // So calculate the width percentage that each of them consume.
    for (i = 0; i < photos_to_be_displayed.length; i++) {

        // current photo
        var p = photos_to_be_displayed[i];

        // current_photo_width_percentage
        var wp = p.reference_width / total_reference_width;


        // Now calculate their dimensions when displayed by multiplying each
        // width percentage to the width of the row container.

        // width
        var w = (CONTAINER_WIDTH * wp) - 1;

        // aspect ratio
        var r = p.raw_width / p.raw_height;

        // height
        var h = w / r;


        // Create the <img>
        var an_img = document.createElement("img");
        an_img.setAttribute("id", p.id);
        an_img.setAttribute("alt", p.title);
        an_img.setAttribute("stack-index", p.stack_index);
        an_img.setAttribute("src", p.src);
        an_img.setAttribute("raw-width", p.raw_width);
        an_img.setAttribute("raw-height", p.raw_height);
        an_img.setAttribute("width", w);
        an_img.setAttribute("height", h);

        // an_img.setAttribute("for-data-flickr-embed", "true");
        an_img.setAttribute("for-href", p.href);


        // Create an individual photo container.
        var individual_container = document.createElement("div");
        // individual_container.setAttribute("title", p.title);
        individual_container.classList.add("individual_photo_container");

        // var caption = get_caption(w, h);
        // individual_container.appendChild(caption);
        individual_container.appendChild(an_img);


        // Append the caption.
        var caption = get_caption2(w, h, an_img);
        individual_container.appendChild(caption);




        // Append the photo to the main container.
        photos_container.appendChild(individual_container);

        // Add event listeners.
        add_click_listener_to_caption(caption);
        // add_mouse_listeners(an_img);
        // add_mouseenter_listener(an_img);
        // add_mouseleave_listener(an_img);

        // $(caption).click(function () {
        //     var the_img = caption.parentElement.childNodes[0];
        //
        //     if (the_img != null &&
        //         $(the_img).is("img") &&
        //         the_img.id == an_img.id) {
        //         show_solo_img(the_img);
        //     }
        //
        //     // show_solo_img(an_img);
        //
        //
        // });
    }

}


// With no timeout handler.
function show_caption_old(the_img) {
    console.log("****************************************");
    console.log("PUTANG EVENT: mouseenter");
    console.log("****************************************");

    // If there's already a caption..
    var caption = the_img.parentElement.childNodes[0];
    if (caption.classList.contains("captions")) {
        return;
    }

    //
    var w = the_img.getAttribute("width");
    var h = the_img.getAttribute("height");


    var caption = get_caption(w, h, the_img);
    the_img.parentElement.insertBefore(caption, the_img);


    //
    //
    $(caption).mouseenter(function (event) {
        // event.stopPropagation();
        // event.stopImmediatePropagation();
        // var the_img = this.parentElement.childNodes[1];

        // show_caption(the_img);
        // is_mouse_on_photo = true;
        // hovered_img = the_img;
    });

    $(caption).mouseover(function (event) {
        // event.stopImmediatePropagation();
        // show_caption(the_img);
        // is_mouse_on_photo = true;
        // hovered_img = the_img;
    });



    // $(caption).mouseleave(function (event) {
    //     // event.stopPropagation();
    //
    //     // var the_img = this.parentElement.childNodes[1];
    //
    //     remove_caption(this);
    // });

    $(caption).mouseout(function (event) {
        // remove_caption(this);
        is_mouse_on_photo = false;
        hovered_caption = this;
    });
}

function show_caption_old2(the_img) {
    if (the_img == null) {
        return;
    }

    // Only discontinue the removal of an img's caption
    // if you're hovering the same img.
    if (just_previously_hovered_img_id == the_img.id) {
        clearTimeout(individual_img_mouseout_handler);
    }


    //
    individual_img_mouseover_handler = setTimeout(function () {

        // If there's already a caption..
        var old_caption = the_img.parentElement.childNodes[0];
        if (old_caption.classList.contains("captions")) {
            return;
        }


        //
        just_previously_hovered_img_id = the_img.id;

        //
        var w = the_img.getAttribute("width");
        var h = the_img.getAttribute("height");

        // var top = $(the_img).css("top");


        var caption = get_caption(w, h, the_img);
        the_img.parentElement.insertBefore(caption, the_img);
    }, 50);
}

function show_caption(the_img) {
    // if (the_img == null) { return; }
    //
    // If there's already a caption..
    var old_caption = the_img.parentElement.childNodes[0];
    if (old_caption.classList.contains("captions")) {
        return;
    }

    var w = the_img.getAttribute("width");
    var h = the_img.getAttribute("height");

    var caption = get_caption(w, h, the_img);
    $(caption).insertBefore($(the_img));

    // TODO:DEBUG
    var edit_link = document.createElement("a");
    edit_link.setAttribute("href", "#");
    edit_link.innerHTML = "go to nba";
    $(edit_link).css("position", "absolute");
    $(edit_link).css("margin-left", "-" + $(the_img).width() + "px");

    $(edit_link).insertAfter($(the_img));

    $(edit_link).mouseover(function (event) {
        event.stopPropagation();
        console.log("propagation stopped");
    });

    $(edit_link).mouseenter(function (event) {
        event.stopPropagation();
        console.log("propagation stopped");
    });

}


function retain_caption(caption) {

    var the_img = caption.parentElement.childNodes[1];

    if (the_img == null) {
        return;
    }

    // Only discontinue the removal of an img's caption
    // if you're hovering the same img.
    if (just_previously_hovered_img_id == the_img.id) {
        clearTimeout(individual_img_mouseout_handler);
    }


    //
    individual_img_mouseover_handler = setTimeout(function () {

        // If there's already a caption..
        var old_caption = the_img.parentElement.childNodes[0];
        if (old_caption.classList.contains("captions")) {
            return;
        }


        //
        just_previously_hovered_img_id = the_img.id;

        //
        var w = the_img.getAttribute("width");
        var h = the_img.getAttribute("height");

        // var top = $(the_img).css("top");


        var caption = get_caption(w, h, the_img);
        the_img.parentElement.insertBefore(caption, the_img);
    }, 10);
}

function remove_caption(the_caption, delay_time) {
    // console.log("****************************************");
    // console.log("PUTANG EVENT: mouseleave");
    // console.log("****************************************");

    // if (individual_img_mouseout_handler != null) { return; }
    if (the_caption == null) {
        return;
    }

    // If it's not a caption, return.
    if (!the_caption.classList.contains("captions")) {
        return;
    }

    if (delay_time == null) {
        delay_time = 200;
    }


    // return;

    //
    setTimeout(function () {

        $(the_caption).remove();

        //
        // var caption = the_caption.parentElement.childNodes[0];

        // if the caption is non-existent, just return.
        // if (caption == null) { return; }
        // if (!caption.classList.contains("captions")) { return; }

        // //
        // clearTimeout(individual_img_mouseover_handler);

        // var parent = the_caption.parentElement;
        // if (parent == null) { return; }
        //
        // parent.removeChild(the_caption);
    }, delay_time);
}

function remove_caption_old(the_img) {
    // if (individual_img_mouseout_handler != null) { return; }

    //
    individual_img_mouseout_handler = setTimeout(function () {

        //
        var caption = the_img.parentElement.childNodes[0];

        // if the caption is non-existent, just return.
        if (!caption.classList.contains("captions")) {
            return;
        }

        //
        // clearTimeout(individual_img_mouseover_handler);

        console.log("MOUSEOUT");

        the_img.parentElement.removeChild(caption);
        console.log("CAPTION REMOVED");
    }, 200);
}


function get_the_photo(embed_code, max_ref_height) {

    var id = "photo" + embed_code['id'];
    var title = embed_code['photo_title'];
    var href = embed_code['href'];
    var src = embed_code['src'];
    var raw_width = embed_code['width'];
    var raw_height = embed_code['height'];

    // Given the aspect ratio of each photo, calculate their widths at
    // that maximum reference height.
    var reference_width = get_reference_width(max_ref_height, raw_width, raw_height);


    var a_photo_to_be_displayed = {
        "id": id,
        "title": title,
        "stack_index": stack_index,
        "href": href,
        "src": src,
        "raw_width": raw_width,
        "raw_height": raw_height,
        "reference_width": reference_width,
        "reference_height": max_ref_height
    };

    ++stack_index;

    //
    return a_photo_to_be_displayed;
}


/**
 * // Given the aspect ratio of each photo, calculate their widths at
 * // that maximum reference height.
 */
function get_reference_width(max_ref_height, raw_width, raw_height) {
    // Aspect ratio
    var r = raw_width / raw_height;

    var reference_width = r * max_ref_height;

    return reference_width;

}


function get_num_of_photos_shown() {
    var num_of_photos = photos_container.childNodes.length - 3 - num_of_horizontal_dividers;
    // window.alert("photos_container.childNodes.length: " + num_of_photos);
    return num_of_photos;
}