function attach_rateable_item_ids(rateable_items) {
    var len = rateable_items.length;

    for (i = 0; i < len; i++) {
        var item_x_id = rateable_items[i]['item_x_id'];
        var rateable_item_id = rateable_items[i]['rateable_item_id'];

        var post_id = "post" + item_x_id;

        // Attach the id.
        $('#' + post_id).find('.b-post-response-bar').attr("rateable-item-id", rateable_item_id);

    }

    are_rateable_item_ids_set = true;
}

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