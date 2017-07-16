function do_friendship_acolytes_after_effects(class_name, crud_type, json) {

    switch (crud_type) {
        case "read":
            //
            prepare_friendship_x_container(class_name);
            var container_tbody = get_x_container_tbody(class_name);

            //
            populate_friend_relationship_container(container_tbody, json.x_friends, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}











