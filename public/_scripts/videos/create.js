function create_video() {
    var crud_type = "create";
    var request_type = "POST";

    var embed_code = $('#embed_code').val();

    var src = get_attribute_value(embed_code, "src");

    // If the attributes are type incorrectly or not at all (eg. hre/hef/ref and
    // not href), then show an error alert.
    if (src == false) { window.alert("Sorry, but the src attribute is not valid..."); return; }

    var key_value_pairs = {
        create: "yes",
        video_title: $('#video_title').val(),
        src: src
    };


    var obj = new MyVideo(crud_type, request_type, key_value_pairs);
    obj.create();
}