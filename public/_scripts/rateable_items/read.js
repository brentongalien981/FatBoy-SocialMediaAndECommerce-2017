function attach_rateable_item_ids(rateable_items) {
    var len = rateable_items.length;

    for (i = 0; i < len; i++) {
        var item_x_id = rateable_items[i]['item_x_id'];
        var rateable_item_id = rateable_items[i]['rateable_item_id'];

        var post_id = "post" + item_x_id;

        // Attach the id.
        $('#' + post_id).find('.b-post-response-bar').attr("rateable-item-id", rateable_item_id);

    }
}