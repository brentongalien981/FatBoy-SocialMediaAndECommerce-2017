function read_invoices() {

    var offset = get_num_of_invoices();

    var crud_type = "read";
    var request_type = "GET";
    var key_value_pairs = {
        read : "yes",
        offset: offset
    };


    var obj = new Invoice(crud_type, request_type, key_value_pairs);
    obj.read();

}

function can_i_read_more_invoices() {

    // Boundaries of the sides of the reference.
    var read_more_invoices_initiator_ref = $("#read-more-invoices-initiator-reference").get(0).getBoundingClientRect();

    //
    var scrolling_el = $("#main_content").get(0).getBoundingClientRect();


    // reference_for_loading_more's relative position to the users_table_container.
    var relative_position_of_reference_el = read_more_invoices_initiator_ref.top - scrolling_el.top - $("#main_content").get(0).scrollTop;


    // // DEBUG:
    // console.log("REL POS: " + relative_position_of_reference_el);


    //
    if (relative_position_of_reference_el <= triggering_distance_for_loading_more_invoices) { return true; }

    return false
}