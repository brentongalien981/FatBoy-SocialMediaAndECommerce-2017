set_rateable_item_ids();

//
function set_rateable_item_ids() {
    var post_ids = get_post_ids();

    read_rateable_item_ids(post_ids);
}

function get_post_ids() {
    var posts = $('.message_post');
    var post_ids = [];

    var length = posts.length;

    for (i=0; i<length; i++) {
        var id = posts[i].id;
        post_ids[i] = id.substring(4);
    }

    return post_ids;
}

function read_rateable_item_ids(post_ids) {

    var crud_type = "read";
    var request_type = "GET";


    var key_value_pairs = {
        read: "yes",
        post_ids: post_ids,
        item_x_type_id: type_id_of_post
    };



    var obj = new RateableItem(crud_type, request_type, key_value_pairs);
    obj.read();
}