function create_photo() {
    var crud_type = "create";
    var request_type = "POST";

    var embed_code = $('#embed_code').val();

    var href = get_attribute_value(embed_code, "href");
    var src = get_attribute_value(embed_code, "src");
    var width = get_attribute_value(embed_code, "width");
    var height = get_attribute_value(embed_code, "height");

    // If the attributes are type incorrectly or not at all (eg. hre/hef/ref and
    // not href), then show an error alert.
    if (href == false) { window.alert("Sorry, but the href attribute is not valid..."); return; }
    if (src == false) { window.alert("Sorry, but the src attribute is not valid..."); return; }
    if (width == false) { window.alert("Sorry, but width attribute is not valid..."); return; }
    if (height == false) { window.alert("Sorry, but the height attribute is not valid..."); return; }

    var key_value_pairs = {
        create: "yes",
        photo_title: $('#photo_title').val(),
        href: href,
        src: src,
        width: width,
        height: height
    };


    var photo = new Photo(crud_type, request_type, key_value_pairs);
    photo.create();
}

/**
 *
 * @param embed_code
 * @param attribute
 * @return {attribute value or bool false}
 */
function get_attribute_value(embed_code, attribute) {
    var start_index = embed_code.indexOf(attribute);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (start_index == -1) { return false; }

    /*
     * For ex:
     *      $start_offset = "href" + "=\"";
     *                    = 4 + 2
     *                    = 6
     */
    start_index += attribute.length + 2;

    var end_index = embed_code.indexOf('"', start_index);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (end_index == -1) { return false; }

    // var attribute_value_length = end_index - start_index;

    var attribute_value = embed_code.substring(start_index, end_index);

    return attribute_value;
}

function clear_add_photo_form() {
    $('#photo_title').val("");
    $('#embed_code').val("");
}