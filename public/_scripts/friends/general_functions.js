function do_friendships_after_effects(class_name, crud_type, json, x_obj) {

    switch (crud_type) {
        case "read":
            //
            break;
        case "create":
            console.log("********************");
            console.log("In METHOD: do_friendships_after_effects(), SWITCH CASE: 'create.'");

            var notification_id = x_obj.key_value_pairs['notification_id'];

            // Delete the notification that corresponds to the
            // "accept" link that has been clicked.
            delete_x_notification_obj("NotificationFriendship", notification_id);
            // dom_remove_notification(class_name, notification_id);
            console.log();
            break;
        case "update":
            break;
        case "delete":
            break;
    }
}



function prepare_friendship_x_container(class_name) {
    var id = class_name + "Container";
    var container = document.getElementById(id);
    main_content.appendChild(container);
}



function get_x_container_tbody(class_name) {
    var id = class_name + "Tbody";
    var tbody = document.getElementById(id);
    return tbody;
}