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
    var raw_img_h = h;
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

    var raw_caption_height = h + chunk;

    // This is if the photo caption is being clipped by the bottom
    // part of the photos_container..
    var photos_container_height = parseInt($('#photos_container').height()) + 60;
    if (photos_container_height < raw_caption_height) {
        h = h - (raw_caption_height - photos_container_height);
    }

    // var caption_top = img_abs_top + (top_offset - img_abs_top);
    var caption_top = img_abs_top + (top_offset - img_abs_top) + chunk;

    var caption = document.createElement("div");
    caption.classList.add("captions");
    $(caption).css("width", w + "px");
    $(caption).css("height", h + "px");
    $(caption).css("top", caption_top);


    // TODO:DEBUG
    return caption;




    console.log("*****************************");

    console.log("img's top: " + img_pos.top);
    // console.log("caption's top: " + $(caption).css("top"));
    console.log("*****************************");




    // //
    // $(caption).mouseenter(function (event) {
        // console.log("this: " + this.parentElement);
        // event.stopPropagation();
        // event.stopImmediatePropagation();
        // retain_caption(this);
    // });

    // $(caption).mouseover(function (event) {
    //     // console.log("this: " + this.parentElement);
    //     event.stopPropagation();
    //     // retain_caption(this);
    // });

    //
    var caption_content_clip_height = parseInt(raw_img_h) - parseInt(h);
    caption_content_clip_height = 0 - caption_content_clip_height;

    var caption_content = get_caption_content(h);

    // $(caption_content).css("margin-top", caption_content_clip_height + "px");
    caption.appendChild(caption_content);


    // for caption_content animation
    // class="animated infinite bounce"
    if (caption_content != null &&
        parseInt(h) < 36) {

        // var icons = caption_content.childNodes[0];
        // if (icons != null) {
        //
        // }

        caption_content.classList.add("animated");
        caption_content.classList.add("fadeOut");


        setTimeout(function () {
            $(caption_content).css("display", "none");
        }, 1000);
    }



    return caption;
}

function get_caption2(w, h, the_img, json) {
    var caption = document.createElement("div");
    caption.classList.add("captions");
    $(caption).css("width", w + "px");
    $(caption).css("height", h + "px");
    // caption.innerHTML = "ptuaosdlfj;lasjfd:";

    // Add the content of the caption.
    caption.appendChild(get_caption_content(h, json));

    $(caption).css("margin-top", "-" + h + "px");


    //
    // $(caption).cl
    //uki

    return caption;
}

function get_caption_content2(w, h) {
    var content = document.createElement("div");
    // content.classList.add("contents");
    $(content).css("width", w + "px");
    $(content).css("height", h + "px");
    $(content).css("display","block");
    $(content).css("background-color","pink");
    return content;
}

function get_caption_content(h, json) {
    var content = document.createElement("div");
    content.classList.add("caption_action_bar");

    // content.innerHTML = "<i class=\"fa fa-sliders my-photo-icons my-photo-icons-edit\" style=\"font-size:20px\">";
    //
    // content.innerHTML += "<i class=\"fa fa-trash my-photo-icons my-photo-icons-delete\" style=\"font-size:20px\"></i>";


    // TODO:NOW
    if (json.is_viewing_own_account) {
        // Create the CRUD action icons.
        var edit_icon = document.createElement("i");
        edit_icon.className = "fa fa-sliders my-photo-icons my-photo-icons-edit";

        var delete_icon = document.createElement("i");
        delete_icon.className = "fa fa-trash my-photo-icons my-photo-icons-delete";

        // Add event listeners to the icons.
        add_click_listener_to_edit_icon(edit_icon);
        add_click_listener_to_delete_icon(delete_icon);

        // Append the icons.
        content.appendChild(edit_icon);
        content.appendChild(delete_icon);
    }


    return content;
}

