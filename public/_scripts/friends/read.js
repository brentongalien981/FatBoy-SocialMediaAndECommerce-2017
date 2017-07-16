function create_friend_relationship_container(class_name) {
    // Container
    var friend_relationship_container = document.createElement("div");
    friend_relationship_container.id = class_name + "Container";
    friend_relationship_container.classList.add("section");
    friend_relationship_container.classList.add("friend_relationship_container_template");

    // Title
    var friend_relationship_title = document.createElement("h4");
    friend_relationship_title.id = class_name + "Title";
    friend_relationship_title.classList.add("friend_relationship_title");

    // <hr>
    var hr = document.createElement("hr");


    // Table
    var friend_relationship_table = document.createElement("table");
    friend_relationship_table.id = class_name + "Table";
    friend_relationship_table.classList.add("friend_relationship_table");

    // tbody
    var friend_relationship_tbody = document.createElement("tbody");
    friend_relationship_tbody.id = class_name + "Tbody";
    friend_relationship_tbody.classList.add("friend_relationship_tbody");





    //
    switch (class_name) {
        case "FriendshipSuggestion":
            friend_relationship_title.innerHTML = "Suggested Friends";
            break;
        case "FriendshipAcolyte":
            friend_relationship_title.innerHTML = "Acolytes";
            break;
        case "FriendshipMuse":
            friend_relationship_title.innerHTML = "Muses";
            break;
    }




    // Append
    friend_relationship_container.appendChild(friend_relationship_title);
    friend_relationship_container.appendChild(hr);
    friend_relationship_container.appendChild(friend_relationship_table);
    friend_relationship_table.appendChild(friend_relationship_tbody);
    main_content.appendChild(friend_relationship_container);




    //
    return friend_relationship_tbody;

}


function populate_friend_relationship_container(container, x_friends, caller_class_name, crud_type) {
    // console.log("PUTA: x_friends.length: " + x_friends.length);

    for (var i = 0; i < x_friends.length; i++) {
        var sf = x_friends[i];
        // console.log("PUTA: sf[notification_msg_id]: " + sf['notification_msg_id']);
        // var prepared_notification = get_prepared_notification(sf);
        var tr = document.createElement("tr");

        var content = "";

        // User pic.
        content += "<td>";
        content += "<img src='" + get_local_url() + sf['user_pic_src'] + "'>";
        content += "</td>";

        // User name.
        content += "<td>";
        content += "<h5>";
        content += sf['user_name'];
        content += "</h5>";

        // Follow button.
        content += "<input id='follow_button" + sf['user_id'] + "'";
        content += " type='button'";
        content += " class='form_button follow_buttons'";
        content += " friend_id='" + sf['user_id'] + "'";
        content += " friend_name='" + sf['user_name'] + "'";
        content += " value='+ follow'";
        content += ">";

        content += "</td>";



        tr.innerHTML = content;
        //
        container.appendChild(tr);



        // Add event listener for the current follow button.
        var current_follow_button = document.getElementById("follow_button" + sf['user_id']);
        add_listener_to_follow_button(current_follow_button);



    }

    //
    if (crud_type === "read" &&
        x_friends.length > 0)
    {

        // The actual container, not just the tbody.
        var actual_container = document.getElementById(caller_class_name + "Container");


        //
        show_x_container(actual_container);

        // // TODO:REMINDER: Start the updates.
        // console.log("VAR-BEFORE:can_friendship_suggested_friends_update: " + can_friendship_suggested_friends_update);
        // can_friendship_suggested_friends_update = true;
        // console.log("VAR-AFTER:can_friendship_suggested_friends_update: " + can_friendship_suggested_friends_update);
    }

}


