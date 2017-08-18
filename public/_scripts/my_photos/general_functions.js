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
            window.alert("TODO: In METHOD: do_photos_after_effects().");

            // // Reset the User Info section's buttons.
            // create_user_button.style.display = "none";
            // cancel_creation_button.style.display = "none";
            // edit_user_button.style.display = "block";
            // add_user_button.style.visibility = "visible";
            //
            // //
            // set_user_info_inputs(DEFAULT);
            //
            // //
            // load_more_users();
            break;
        case "update":
            //
            // update_user_info_display(x_obj.key_value_pairs['user_id']);
            break;
        case "delete":
            break;
    }
}





function populate_photos_container(photos, class_name, crud_type, x_obj) {

    //
    for (var i = 0; i < photos.length; i++) {
        var p = photos[i];


        // Create a horizontal margin every 5 photos.
        if ((get_num_of_photos_shown() > 1) &&
            ((get_num_of_photos_shown() % 5) == 0)) {
            var horizontal_divider = document.createElement("div");
            horizontal_divider.classList.add("horizontal_divider");
            photos_container.appendChild(horizontal_divider);

            ++num_of_horizontal_dividers;
        }



        // Create an individual photo container.
        var individual_container = document.createElement("div");
        individual_container.classList.add("individual_photo_container");
        individual_container.innerHTML = p['embed_code'];


        // Append the photo to the main container.
        photos_container.appendChild(individual_container);

        // Update the reference_for_loading_more element.
        photos_container.appendChild(reference_for_loading_more);
    }

    // FLAG
    // Set up for the next "load more".
    is_ajax_reading = false;
}






function get_num_of_photos_shown() {
    var num_of_photos = photos_container.childNodes.length - 3 - num_of_horizontal_dividers;
    // window.alert("photos_container.childNodes.length: " + num_of_photos);
    return num_of_photos;
}