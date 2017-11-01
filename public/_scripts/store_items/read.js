function read_store_items(for_what) {

    var offset = get_num_of_store_items();
    // var offset = 0;

    for_what = (for_what == null) ? "nothing" : for_what;

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        offset: offset,
        for_what: for_what
    };


    var obj = new StoreItem(crud_type, request_type, key_value_pairs);
    obj.read();

}

function can_i_edit_more_store_items() {

    // Boundaries of the sides of the reference.
    var edit_more_store_items_initiator_ref = $("#edit-more-store-items-initiator-reference").get(0).getBoundingClientRect();

    //
    var scrolling_el = $("#product-items-list-container").get(0).getBoundingClientRect();


    // reference_for_loading_more's relative position to the users_table_container.
    var relative_position_of_reference_el = edit_more_store_items_initiator_ref.top - scrolling_el.top - $("#product-items-list-container").get(0).scrollTop;


    // DEBUG:
    console.log("REL POS: " + relative_position_of_reference_el);


    //
    if (relative_position_of_reference_el <= triggering_distance_for_editing_more_invoices) { return true; }

    return false
}