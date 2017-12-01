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



function clear_add_photo_form() {
    $('#photo_title').val("");
    $('#embed_code').val("");
}