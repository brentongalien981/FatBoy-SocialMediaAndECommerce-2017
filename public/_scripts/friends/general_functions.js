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



function decide_ajax_after_effects_class_handlers(x_friendship_obj, json) {
    var class_name = x_friendship_obj.class_name;
    var crud_type = x_friendship_obj.crud_type;

    //
    switch (class_name) {
        case "FriendshipSuggestion":
            do_friendship_suggestions_after_effects(class_name, crud_type, json);
            break;
        case "xXx":
            break;
        case "yYy":
            break;
        case "zZz":
            break;
    }
}



// @deprecated
// TODO:REMINDER: Refactor this and move it to FILE main_script.js.
function my_ajax(x_friendship_obj) {
    var caller_class_name = x_friendship_obj.class_name;
    var crud_type = x_friendship_obj.crud_type;
    var request_type = x_friendship_obj.request_type;
    var key_value_pairs_arr = x_friendship_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);





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
                decide_ajax_after_effects_class_handlers(x_friendship_obj, json);


            }



            // Show a flash notification of the overall result.
            show_flash_notification(x_friendship_obj, json);








            // AJAX Formatted JSON log.
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