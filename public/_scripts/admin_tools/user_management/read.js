function read_user_objs(offset_param, is_initial_search_param) {
    // //
    // if (filter_search_checkbox.checked) {
    //     searched_user_infos.user_id = $('#filtered_search_user_id_input').val();
    // }
    // else {
    //     searched_user_infos.user_id = $('#simple_search_text_input').val();
    // }


    var crud_type = "read";
    var request_type = "GET";
    var offset;
    var is_initial_search;

    if (offset_param == null) {
        offset = get_num_of_users_shown();
    }
    else {
        offset = offset_param;

        // Reset the user_counter.
        user_counter = 1;

    }



    if (is_initial_search_param == null) {
        is_initial_search = false;
    }
    else if (is_initial_search_param == true) {
        is_initial_search = true;
    }
    else {
        is_initial_search = false;
    }



    //
    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        offset: offset,
        is_initial_search: is_initial_search
    };



    //
    for (var key in searched_user_infos) {
        if(searched_user_infos.hasOwnProperty(key)) {
            key_value_pairs[key] = searched_user_infos[key];
        }
    }


    var user_obj_request = new User(crud_type, request_type, key_value_pairs);
    user_obj_request.read();
}





function load_more_users() {
    read_user_objs();
}