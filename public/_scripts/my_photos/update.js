function populate_edit_form(edit_icon) {
    var current_photo_container = edit_icon.parentElement.parentElement.parentElement;
    var current_photo = current_photo_container.childNodes[0];

    // console.log("current_photo.id" + current_photo.id);

    // $('#edit_photo_title').attr('value', $(current_photo).attr('alt'));
    $('#edit_photo_title').val($(current_photo).attr('alt'));
    // var edit_photo_title = document.getElementById("edit_photo_title");
    // edit_photo_title.setAttribute("value", $(current_photo).attr("alt"));

    var edit_embed_code = "<a";
    edit_embed_code += " data-flickr-embed=\"true\"";
    edit_embed_code += " href=\"" + $(current_photo).attr("for-href") + "\"";
    edit_embed_code += " title=\"" + $(current_photo).attr("alt") + "\">";
    edit_embed_code += "<img src=\"" + $(current_photo).attr("src") + "\"";
    edit_embed_code += " width=\"" + $(current_photo).attr("raw-width") + "\"";
    edit_embed_code += " height=\"" + $(current_photo).attr("raw-height") + "\"";
    edit_embed_code += " alt=\"" + $(current_photo).attr("alt") + "\"";
    edit_embed_code += "</a>";


    $("#edit_embed_code").html(edit_embed_code);
    $("#edit_photo_id").attr("value", $(current_photo).attr("id"));

    //for-href
    // $("#edit_photo_title").attr("value", $(current_photo).attr("alt"));


    // cover_photo(current_photo_container, current_photo);
}

function update_photo() {

    var crud_type = "update";
    var request_type = "POST";

    var photo_id = $('#edit_photo_id').val();
    photo_id = photo_id.substring(5); // Remove the "photo" from photo113
    var photo_title = $('#edit_photo_title').val();
    var photo_embed_code = $('#edit_embed_code').val();

    var key_value_pairs = {
        update: "yes",
        edit_photo_id: photo_id,
        edit_photo_title: photo_title,
        edit_embed_code: photo_embed_code

    };



    var edit_photo_request = new Photo(crud_type, request_type, key_value_pairs);
    edit_photo_request.update();
}

function cover_photo(photo_container, photo) {


    // var photo_cover = $('#photo_cover');
    // photo_container.appendChild(photo_cover);
    $(photo_container).append($('#photo_cover'));

    $('#photo_cover').css("display", "block");
    $('#photo_cover').css("margin-top", "-" + ($(photo).height()) + "px");
    $('#photo_cover').width($(photo).width());
    $('#photo_cover').height($(photo).height()-20);
}

function clear_edit_photo_form() {
    // This version of changing the input values
    // doesn't seem to work.
    // $('#edit_photo_title').val("");
    // $('#edit_embed_code').val("");

    // But this works.
    $('#edit_photo_title').attr('value', '');
    $('#edit_embed_code').html('');

}

function b_animate_hide_edit_photo_form() {
    b_remove_animation($('#edit_photo_form').get(0), "fadeInDown");
    b_add_animation($('#edit_photo_form').get(0), "fadeOutUp");

    setTimeout(function () {
        hide_element($('#edit_photo_form'));
    }, 500);
}

function dom_update_element(x_obj) {
    // Fucking hell.
    var id = "photo" + x_obj.key_value_pairs['edit_photo_id'];
    //
    var new_title = x_obj.key_value_pairs['edit_photo_title'];
    $('#' + id).attr("alt", new_title);
}