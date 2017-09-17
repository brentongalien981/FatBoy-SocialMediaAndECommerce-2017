function show_flash_notification(x_obj, json) {
    // TODO:REMINDER: Make the notification more presentable in production.
    if (json == null || !json.is_result_ok) {
        // FAIL on [crud]ing [x]Notification.
        // window.alert("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
    else {
        // SUCCESS on [crud]ing [x]Notification.
        // window.alert("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
}


/**
 * Get the subfolder of the appropriate xAjaxHandler.php.
 * @param class_name
 * @return {string}
 */
function get_subfolder(class_name) {
    //
    var subfolder = "";

    switch (class_name) {
        case "FriendshipSuggestion":
            subfolder = "friends";
            break;
        case "FriendshipAcolyte":
            subfolder = "friends";
            break;
        case "FriendshipMuse":
            subfolder = "friends";
            break;
        case "Friendship":
            subfolder = "friends";
            break;
        case "NotificationFriendship":
        // subfolder = "notifications";
        // break;
        case "NotificationMyShopping":
        // subfolder = "notifications";
        // break;
        case "NotificationPost":
        // subfolder = "notifications";
        // break;
        case "NotificationRateableItem":
            subfolder = "notifications";
            break;
        case "User":
            subfolder = "admin_tools/user_management";
            break;
        case "Photo":
            subfolder = "my_photos";
            break;
        case "RateableItem":
            subfolder = "rateable_items";
            break;
        case "RateableItemUser":
            subfolder = "rateable_items_users";
            break;
        case "ChatList":
            subfolder = "chat_list";
            break;
        case "ChatMessage":
            subfolder = "chat_message";
            break;
        case "AppSetting":
            subfolder = "app_settings";
            break;
        case "zZz":
            break;
    }


    return subfolder;
}


function show_x_container(container) {
    container.style.display = "block";
}

function show_x_container2(class_name) {
    $("#" + class_name + "Container").css("display", "block");
}


function hide_x_container(container) {
    container.style.display = "none";
}

function hide_x_container2(class_name) {
    // container.style.display = "none";
    $("#" + class_name + "Container").css("display", "none");
}


function decide_ajax_after_effects_class_handlers(x_obj, json) {
    var class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;

    //
    switch (class_name) {
        case "FriendshipSuggestion":
            do_friendship_suggestions_after_effects(class_name, crud_type, json);
            break;
        case "FriendshipAcolyte":
            do_friendship_acolytes_after_effects(class_name, crud_type, json);
            break;
        case "FriendshipMuse":
            do_friendship_muses_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Friendship":
            do_friendships_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationFriendship":
            do_notification_friendships_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationMyShopping":
            do_notification_my_shoppings_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationPost":
            do_notification_posts_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationRateableItem":
            do_notification_rateable_items_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "User":
            do_users_after_effects(class_name, crud_type, json, x_obj);
            // window.alert("TODO:METHOD:do_notification_users_after_effects()");
            break;
        case "Photo":
            do_photos_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "RateableItem":
            do_rateable_item_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "RateableItemUser":
            do_rateable_item_user_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "ChatList":
            do_chat_list_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "ChatMessage":
            do_chat_message_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "AppSetting":
            do_app_setting_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "zZz":
            break;
    }
}


function get_key_value_pairs(key_value_pairs, request_type) {
    var arranged_key_value_pairs = "";

    //
    if (request_type == "GET") {
        arranged_key_value_pairs += "?";
    }
    // Create a dynamic hidden csrf_token input.
    else if (request_type == "POST") {
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


function my_ajax(x_obj) {
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    var request_type = x_obj.request_type;
    var key_value_pairs_arr = x_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);


    //
    var url = get_local_url() + "/public/__controller/" + get_subfolder(caller_class_name) + "/" + caller_class_name + "AjaxHandler.php";
    var xhr = new XMLHttpRequest();


    // Further set the url for "GET" request.
    if (request_type === "GET") {
        url += key_value_pairs_str;
    }


    //
    xhr.open(request_type, url, true);


    // TODO:DEBUG
    console.log("REQUEST TYPE: " + request_type);
    console.log("crud_type: " + crud_type);
    console.log("url: " + url);
    console.log("key_value_pairs_str: " + key_value_pairs_str);
    console.log("caller_class_name: " + caller_class_name);


    //
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


                // "After-Effects" tasks if the AJAX is ok.
                decide_ajax_after_effects_class_handlers(x_obj, json);


            }


            // Show a flash notification of the overall result.
            show_flash_notification(x_obj, json);


            // AJAX Formatted JSON log.
            console.log("*******************************");
            console.log("*** Formatted JSON in class: " + caller_class_name);
            console.log("*** CRUD Type: " + crud_type);
            for (var key in json) {
                if (json.hasOwnProperty(key)) {
                    var val = json[key];

                    // Display in the console.
                    console.log(key + " => " + val);


                    // continue;
                    // Display errors in the form.
                    if (json.form_errors_showable) {
                        var error_label = document.getElementById(key);
                        if (error_label != null) {
                            // Reset the error labels.
                            error_label.innerHTML = "error";
                            error_label.style.visibility = "hidden";


                            // Display error labels.
                            if (val != "") {
                                error_label.innerHTML = val;
                                error_label.style.visibility = "visible";
                            }

                        }
                    }
                }
            }


        }
    };


    // Send.
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