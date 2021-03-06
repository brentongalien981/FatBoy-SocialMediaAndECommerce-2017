function clear_photos_container() {
    // photos_container
    // individual_photo_container
    var child_nodes = photos_container.childNodes;


    // actual current index of the child node.
    var j = 0;
    var length = child_nodes.length;

    for (i = 0; i < length; i++) {
        var child = child_nodes[j];

        if ($(child).is("div") &&
            (child.classList.contains("individual_photo_container") || child.classList.contains("horizontal_divider"))) {
            // child.classList.contains("individual_photo_container")) {
            photos_container.removeChild(child);
        }
        else {
            ++j;
        }
    }

    //
    num_of_horizontal_dividers = 0;
    stack_index = 0;
    // window.alert("get_num_of_photos_shown(): " + get_num_of_photos_shown());

    // var horizontal_dividers = document.getElementsByClassName("horizontal_divider");
    // var len = horizontal_dividers.length;
    //
    // for (i = 0; i < len; i++) {
    //     photos_container.removeChild(horizontal_dividers[0]);
    // }
}


function clear_solo_img_container() {
    var length = solo_img_container.childNodes.length;

    for (i = 0; i < length; i++) {
        solo_img_container.removeChild(solo_img_container.childNodes[0]);
    }
}

function delete_photo(photo_id) {
    var crud_type = "delete";
    var request_type = "POST";

    var key_value_pairs = {
        delete: "yes",
        photo_id: photo_id
    };



    var delete_photo_request = new Photo(crud_type, request_type, key_value_pairs);
    delete_photo_request.delete();
}