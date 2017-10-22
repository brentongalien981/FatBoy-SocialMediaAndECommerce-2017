function do_rateable_item_after_effects(class_name, crud_type, json, x_obj) {


    switch (crud_type) {
        case "read":

            // prepare_users_container(class_name);
            // var container = get_users_container(class_name);
            //
            // //
            // populate_photos_container(json.photos, class_name, crud_type, x_obj, json);
            console.log("***************************************************");
            console.log("TODO: METHOD: do_rateable_item_after_effects().");
            console.log("TODO: switch case 'read'.");
            console.log("***************************************************");

            /* set_rateable_item_ids */
            attach_rateable_item_ids(json.rateable_items);


            /* */
            var rateable_item_id = json.rateable_items[0]["rateable_item_id"];
            var rateable_item_ids = [rateable_item_id];

            // Because I initially created this method "read_rate_tag()" that accepts
            // an array argument, I just kinna stick with it cause I don't wanna
            // re-write the whole RateableItemController file.
            read_rate_tag(rateable_item_ids);
            read_rate_sigma(rateable_item_ids);
            read_rate_value_sigma(rateable_item_ids);

            break;
        case "create":
            var item_x_id = json["item_x_id"];

            /* Read the rateable item. */
            var post_ids = [item_x_id];
            read_rateable_item_ids(post_ids);

            break;

        case "update":
            // //
            // dom_update_element(x_obj);
            // clear_edit_photo_form();
            // b_animate_hide_edit_photo_form();
            // clear_error_labels();


            break;
        case "delete":
            // //
            // clear_photos_container();
            // read_photos();

            break;
    }
}


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

function hide_create_post_form() {
    show_element($('#create_post_link'), "inline");


    b_remove_animation($('#create_post_form').get(0), "fadeInDown");
    b_add_animation($('#create_post_form').get(0), "fadeOutUp");

    setTimeout(function () {
        hide_element($('#create_post_form'));
    }, 500);
}