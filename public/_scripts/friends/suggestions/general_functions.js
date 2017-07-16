function do_friendship_suggestions_after_effects(class_name, crud_type, json) {

    switch (crud_type) {
        case "read":
            //
            var container_tbody = create_friend_relationship_container(class_name);

            //
            populate_friend_relationship_container(container_tbody, json.suggested_friends, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}











