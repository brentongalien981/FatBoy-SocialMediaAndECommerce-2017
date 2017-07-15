// @deprecated
// TODO:REMINDER: Refactor this and move it to FILE main_script.js.
function my_ajax(x_notification_obj) {
    var caller_class_name = x_notification_obj.class_name;
    var crud_type = x_notification_obj.crud_type;

    var url = get_local_url() + "/public/__controller/notifications/" + caller_class_name + "AjaxHandler.php";


    var request_type = String(x_notification_obj.request_type);


    var key_value_pairs_arr = x_notification_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);


    var xhr = new XMLHttpRequest();


    // Further set the url for "GET" request.
    if (request_type === "GET") {
        // url += "?" + crud_type + "=yes&";

        url += key_value_pairs_str;
    }


    xhr.open(request_type, url, true);


    // TODO:DEBUG
    console.log("REQUEST TYPE: " + request_type);
    console.log("crud_type: " + crud_type);
    console.log("url: " + url);
    console.log("key_value_pairs_str: " + key_value_pairs_str);
    console.log("caller_class_name: " + caller_class_name);


    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            // Log before JSON parsing.
            console.log("*******************************");
            console.log("*** AJAX invoked by class: " + caller_class_name);
            console.log("*** CRUD Type: " + crud_type);

            console.log("*** Log before JSON parsing ***");
            console.log("response: " + response);


            //
            var json = null;

            try {
                json = JSON.parse(response);
            } catch (e) {
                console.log('ERROR:invalid json');
                json = null;
            }


            // If the response is not successful..
            if (json === null || !json.is_result_ok) {
                console.log("RESULT:json.is_result_ok: null/false");
            } else if (json.is_result_ok) {
                // Else if it's successful..
                console.log("RESULT:json.is_result_ok: " + json.is_result_ok);


                // TODO:REMINDER: Refactor this and use the after_effects_methods() instead.
                switch (crud_type) {
                    case "read":
                        // Container_id = notification_info.class_name + “container”
                        var container_id = caller_class_name + "Container";
                        // Container = clone_categorized_noti_templ(container_id)
                        var container = clone_categorized_notification_template(container_id);

                        //
                        console.log("*********** ++++++ *********");
                        console.log("calling METHOD: populate_container()");
                        populate_container(container, json.notifications, caller_class_name, crud_type);

                        //
                        console.log("*********** ++++++ *********");
                        console.log("UKINNAYO MET!");

                        break;
                    case "create":
                        break;
                    case "update":
                        //
                        var container_id = caller_class_name + "Container";
                        var container = document.getElementById(container_id);

                        //
                        populate_container(container, json.notifications, caller_class_name, crud_type);
                        break;
                    case "delete":
                        // TODO:REMINDER
                        var notification_id = x_notification_obj.key_value_pairs['notification_id'];
                        dom_remove_notification(caller_class_name, notification_id);
                        console.log();
                        break;
                }


            }


            // Show a flash notification of the overall result.
            show_flash_notification(x_notification_obj, json);


            // AJAX JSON log.
            console.log("*******************************");
            console.log("*** Formatted JSON in class: " + caller_class_name);
            console.log("*** CRUD Type: " + crud_type);
            for (var key in json) {
                if (json.hasOwnProperty(key)) {
                    var val = json[key];

                    // Display in the console.
                    console.log(key + " => " + val);

//                            // Display errors in the form.
//                            var error_label = document.getElementById(key);
//                            if (error_label != null) {
//                                error_label.innerHTML = val;
//                            }
                }
            }


        }
    };


    if (request_type === "GET") {
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();
    }
    else {
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(key_value_pairs_str);
    }
}



function my_sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}



function get_key_value_pairs(key_value_pairs, request_type) {
    var arranged_key_value_pairs = "";

    //
    if (request_type == "GET") {
        arranged_key_value_pairs += "?";
    }
    else if (request_type == "POST") {
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);

        //
        arranged_key_value_pairs += "csrf_token=" + document.getElementById("input_csrf_token").value + "&";

        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);
    }


    //
    for (var key in key_value_pairs) {
        arranged_key_value_pairs += key + "=" + key_value_pairs[key] + "&";
    }

    return arranged_key_value_pairs;
}


/**
 *
 * @param new_container_id
 * @return {Node}
 */
function clone_categorized_notification_template(new_container_id) {
    //
    var container = categorized_notification_container_template.cloneNode(true);

    // Append
    main_content.appendChild(container);

    // Change the id.
    container.id = new_container_id;

    //
    return container;

}


function populate_container(container, notifications, class_name, crud_type) {
    console.log("PUTA: notifications.length: " + notifications.length);

    for (var i = 0; i < notifications.length; i++) {
        var notification = notifications[i];
        console.log("PUTA: notification[notification_msg_id]: " + notification['notification_msg_id']);
        var prepared_notification = get_prepared_notification(notification);

        append_a_notification(container, prepared_notification);

        //
        add_listener_to_delete_notification_link(notification, class_name);
    }

    //
    if (crud_type === "read" &&
        notifications.length > 0)
    {
        // TODO:DEBUG
        console.log("*********** ++++++ *********");
        console.log("In METHOD: populate_container()");
        console.log("crud_type === read");
        console.log("notifications.length > 0");

        //
        show_x_container(container);

        // Start the updates.
        console.log("VAR-BEFORE:can_friendship_notifications_update: " + can_friendship_notifications_update);
        can_friendship_notifications_update = true;
        console.log("VAR-AFTER:can_friendship_notifications_update: " + can_friendship_notifications_update);
    }

}


function get_prepared_notification(notification) {
    var notification_msg_id = notification['notification_msg_id'];
    // var prepared_notification = "<p class='notifications'>";
    var prepared_notification = document.createElement("p");
    prepared_notification.classList.add("notifications");
    prepared_notification.id = "notification" + notification['notification_id'];

    var content = "";

    console.log("DEBUG:VAR:notification_msg_id: " + notification_msg_id);


    //
    content += get_delete_notification_link(notification);



    //
    switch (notification_msg_id) {
        case "2": // Follow acceptance...
            content += get_notification_for_follow_request(notification);
            break;
        case "3": // Follow request...
            content += get_notification_for_follow_acceptance(notification);
            break;
    }

    // prepared_notification += '</p>';
    prepared_notification.innerHTML = content;


    return prepared_notification;
}


function append_a_notification(container, prepared_notification) {
    container.appendChild(prepared_notification);
    // container.innerHTML += prepared_notification;
    // console.log("INNERHTML: " + prepared_notification);
}


function show_x_container(container) {
    container.style.display = "block";
}