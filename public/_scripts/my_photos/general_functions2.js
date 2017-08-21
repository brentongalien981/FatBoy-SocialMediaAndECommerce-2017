function set_solo_view_container() {

    var the_body = document.getElementById("the_body");

    $('#solo_view_container').css("display", "none");

    $('#solo_view_container').css("width", the_body.scrollWidth + "px");
    $('#solo_view_container').css("height", the_body.scrollHeight + "px");

    $('#solo_view_container').css("display", "block");
}





function get_referenced_img(old_stack_index, which_img) {
    var nodes = photos_container.childNodes;
    var index_incrementor = 0;

    if (which_img == "next") {
        index_incrementor = 1;
    }
    else {
        index_incrementor = -1;
    }

    var new_index = parseInt(old_stack_index) + parseInt(index_incrementor);

    // Get the reference to an element based on its attribute.
    return $("[stack-index=" + new_index + "]");
}





function show_solo_img(referenced_img) {
    //
    if (referenced_img == null) { return; }


    // // TODO:DEBUG
    // console.log("************************");
    // console.log("referenced_img.id: " + referenced_img.id);
    // console.log("************************");
    // return;

    // Create the new solo img.
    var solo_img = document.createElement("img");
    solo_img.setAttribute("referencing-photo-id", referenced_img.id);
    solo_img.setAttribute("referencing-stack-index", referenced_img.getAttribute("stack-index"));
    solo_img.setAttribute("src", referenced_img.src);

    var raw_width = referenced_img.getAttribute("raw-width");
    var raw_height = referenced_img.getAttribute("raw-height");
    var w = raw_width;
    var h = raw_height;

    if (raw_width > 1100) {
        var r = raw_width / raw_height;
        var w = 1100;
        var h = w / r;
    }

    solo_img.setAttribute("width", w);
    solo_img.setAttribute("height", h);


    //
    clear_solo_img_container();
    solo_img_container.appendChild(solo_img);

    // window.alert("the_body.scrollWidth: " +the_body.scrollWidth);

    set_solo_view_container();
}