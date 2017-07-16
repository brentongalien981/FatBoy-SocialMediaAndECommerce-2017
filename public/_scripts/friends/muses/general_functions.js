function do_friendship_muses_after_effects(class_name, crud_type, json, x_obj) {

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
            var muse_user_id = x_obj.key_value_pairs['muse_user_id'];
            dom_remove_muse(muse_user_id);
            break;
    }
}



function dom_remove_muse(muse_user_id) {
    console.log("****************************");
    console.log("In METHOD: dom_remove_muse()");
    console.log("****************************");
    var tr = document.getElementById("tr_muse" + muse_user_id);
    tr.parentElement.removeChild(tr);

}











