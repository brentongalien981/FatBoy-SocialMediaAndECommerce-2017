function create_photo() {
    var crud_type = "create";
    var request_type = "POST";
    var key_value_pairs = {
        create: "yes",
        photo_title: $('#photo_title').val(),
        embed_code: $('#embed_code').val()
    };



    var photo = new Photo(crud_type, request_type, key_value_pairs);
    photo.create();
}