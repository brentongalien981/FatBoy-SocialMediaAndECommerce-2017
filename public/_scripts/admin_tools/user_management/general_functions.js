function do_users_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            //
            // prepare_users_container(class_name);
            var container = get_users_container(class_name);

            //
            populate_users_container(container, json.users, class_name, crud_type, x_obj);
            break;
        case "create":
            console.log("TODO:DEBUG: User created after effects");

            // Reset the User Info section's buttons.
            create_user_button.style.display = "none";
            cancel_creation_button.style.display = "none";
            edit_user_button.style.display = "block";
            add_user_button.style.visibility = "visible";

            //
            set_user_info_inputs(DEFAULT);

            //
            load_more_users();
            break;
        case "update":
            //
            update_user_info_display(x_obj.key_value_pairs['user_id']);
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
    content += user_counter;
    content += "</td>";

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
    content += "<td class='user_info'>";
    content += u['private'];
    content += "</td>";

    //
    content += "<td class='user_info'>";
    content += u['account_status_id'];
    content += "</td>";


    //
    content += "<td class='user_info'>";
    content += "<button class='form_button' id='edit_user_button" + u['user_id'] + "'>edit</button>";
    content += "</td>";


    //
    return content;
}





function append_a_row(container, prepared_user_row) {
    container.appendChild(prepared_user_row);
}





function populate_users_container(container, users, class_name, crud_type, x_obj) {
    //
    if (x_obj.key_value_pairs['is_initial_search'] != null &&
        x_obj.key_value_pairs['is_initial_search'] == true) {
        clear_container(container);
    }



    //
    for (var i = 0; i < users.length; i++) {
        var u = users[i];
        
        var prepared_user_row = get_prepared_user_row(class_name, u);

        //
        append_a_row(container, prepared_user_row);

        //
        ++user_counter;

        //edit_user_button
        add_listener_to_edit_user_buttonx(u['user_id']);
        // add_listener_to_delete_notification_link(u, class_name);
    }

    // FLAG
    // Set up for the next "load more".
    is_ajax_reading = false;
}






function prepare_users_container(class_name) {
    var id = class_name + "sTable";
    var container = document.getElementById(id);
    main_content.appendChild(container);
}





function get_num_of_users_shown() {
    return UsersContainer.childNodes.length - 3;
}



function get_users_container(class_name) {

    var id = class_name + "s" + "Container";
    var tbody = document.getElementById(id);
    return tbody;
}