// var firstPhoto = document.getElementById("first-photo");
// firstPhoto.addEventListener("click", function () {
//     this.style.zoom = "200%";
// });

// <script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>







/* Functions */
function read_photos() {
    // FLAG
    if (is_ajax_reading) { return; }
    is_ajax_reading = true;

    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_photos_shown();


    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        offset: offset
    };



    var photo_read_request = new Photo(crud_type, request_type, key_value_pairs);
    photo_read_request.read();
}





function get_caption(w, h, the_img) {
    var img_pos = get_absolute_pos(the_img);
    // var caption_top = parseInt(img_pos.top) - parseInt(photos_container.scrollTop);// - parseInt($('#the_body').scrollTop());
    var img_abs_top = parseInt(img_pos.top) - parseInt(photos_container.scrollTop);// - parseInt($('#the_body').scrollTop());
    var top_offset = 95;

    // var temp_h = h - (top_offset - img_abs_top);
    // var h = h - (top_offset - img_abs_top);

    // height between the img's top to the bottom of the context-sensitive nav.
    var chunk = 0 - (top_offset - img_abs_top);
    if (chunk < 0) {
        chunk = 0;
    }

    //
    var h = h - (top_offset - img_abs_top) - chunk;

    // if (temp_h <= h) {
    //     h = temp_h;
    // }

    // var caption_top = img_abs_top + (top_offset - img_abs_top);
    var caption_top = img_abs_top + (top_offset - img_abs_top) + chunk;

    var caption = document.createElement("div");
    caption.classList.add("captions");
    $(caption).css("width", w + "px");
    $(caption).css("height", h + "px");
    $(caption).css("top", caption_top);

    caption.innerHTML = "<div class='sample_inner_caption'><i class=\"fa fa-gears\" style=\"font-size:36px\"></i></div>";
    console.log("*****************************");

    console.log("img's top: " + img_pos.top);
    // console.log("caption's top: " + $(caption).css("top"));
    console.log("*****************************");




    // //
    // $(caption).mouseover(function (event) {
    //     // console.log("this: " + this.parentElement);
    //     event.stopPropagation();
    //     // retain_caption(this);
    // });

    // $(caption).mouseleave(function (event) {
    //     event.stopPropagation();
    //
    //     // var the_img = this.parentElement.childNodes[1];
    //
    //     remove_caption(this);
    // });

    return caption;
}

