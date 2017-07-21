function do_users_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            // prepare_users_container(class_name);
            var container = get_users_container(class_name);

            //
            populate_users_container(container, json.users, class_name, crud_type);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}





function get_prepared_user_row(class_name, user) {
    var u = user;

    var prepared_user_tr = document.createElement("tr");
    prepared_user_tr.classList.add("user_trs");
    prepared_user_tr.id = "user_tr" + u['user_id'];

    var content = "";
    content += get_user_tds(u);


    prepared_user_tr.innerHTML = content;
    return prepared_user_tr;
}





function get_user_tds(user) {
    var u = user;
    var content = "";

    //
    content += "<td class='user_info'>";
    content += u['user_id'];
    content += "</td>";

    //
    content += "<td class='user_info'>";
    content += u['user_name'];
    content += "</td>";

    //
    content += "<td class='user_info'>";
    content += u['email'];
    content += "</td>";

    //
    content += "<td class='user_info'>";
    content += u['user_type_id'];
    content += "</td>";


    //
    return content;
}





function append_a_row(container, prepared_user_row) {
    container.appendChild(prepared_user_row);
}





function populate_users_container(container, users, class_name, crud_type) {
    
    for (var i = 0; i < users.length; i++) {
        var u = users[i];
        
        var prepared_user_row = get_prepared_user_row(class_name, u);

        //
        append_a_row(container, prepared_user_row);

        // //
        // add_listener_to_delete_notification_link(u, class_name);
    }


    // FLAG
    is_ajax_reading = false;
}






function prepare_users_container(class_name) {
    var id = class_name + "sTable";
    var container = document.getElementById(id);
    main_content.appendChild(container);
}



function get_users_container(class_name) {

    var id = class_name + "s" + "Container";
    var tbody = document.getElementById(id);
    return tbody;
}