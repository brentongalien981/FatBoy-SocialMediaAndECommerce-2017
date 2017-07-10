function my_ajax(x_notification_obj) {
    var caller_class_name = x_notification_obj.class_name;
    var crud_type = x_notification_obj.crud_type;

    var url = get_local_url() + "/public/__controller/notifications/" + caller_class_name + "Handler.php";



    var request_type = String(x_notification_obj.request_type);






    var key_value_pairs_arr = x_notification_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr);



    var xhr = new XMLHttpRequest();


    // Further set the url for "GET" request.
    if (request_type === "GET") {
        url += "?" + crud_type + "=yes&";

        url += key_value_pairs_str;

    }


    xhr.open(request_type, url, true);







    // TODO:DEBUG
    console.log("REQUEST TYPE: " + request_type);
    console.log("url: " + url);
    console.log("key_value_pairs_str: " + key_value_pairs_str);






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

            }






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


function get_key_value_pairs (key_value_pairs) {
    var arranged_key_value_pairs = "";

    for (var key in key_value_pairs) {
        arranged_key_value_pairs += key + "=" + key_value_pairs[key] + "&";
    }

    return arranged_key_value_pairs;
}


function clone_categorized_notification_template(new_container_id) {

}


function populate_container(container_id, notifications) {

}


function append_a_notification(container_id, notification) {

}


function show_x_container(container) {

}


function show_flash_notification(notification_msg_id) {

}