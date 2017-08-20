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
        else { ++j; }
    }

    //
    num_of_horizontal_dividers = 0;
    window.alert("get_num_of_photos_shown(): " + get_num_of_photos_shown());

    // var horizontal_dividers = document.getElementsByClassName("horizontal_divider");
    // var len = horizontal_dividers.length;
    //
    // for (i = 0; i < len; i++) {
    //     photos_container.removeChild(horizontal_dividers[0]);
    // }
}