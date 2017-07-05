<script>
    // Vars
    var is_delete_follow_notification_record_done = false;




    // Tasks





    // Functions


    function delete_follow_notification_record(notification_id) {
        console.log("*************************");
        console.log("Inside METHOD: delete_follow_notification_record().");
        console.log("VAR:notification_id: " + notification_id);
        
        var url = "<?php echo LOCAL . "/public/__controller/notifications/index.php"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: delete_follow_notification_record(). ***");
                console.log("*** Log before JSON parsing ***");
                console.log("response: " + response);



                //
                var json = null;

                try
                {
                    json = JSON.parse(response);
                } catch (e)
                {
                    console.log('ERROR:invalid json');
                    json = null;
                }


                // If the response is not successful..
                if (json == null || !json.is_result_ok) {
                    console.log("RESULT:json.is_result_ok: null/false");
                } else if (json.is_result_ok) {
                    // Else if it's successful..
                    console.log("VAR:json.is_result_ok: " + json.is_result_ok);
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in METHOD: delete_follow_notification_record(). ***");
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



                is_delete_follow_notification_record_done = true;
            }
        };


        //
        xhr.send(get_post_key_value_pairs_for_delete_follow_notification_record(notification_id));
    }


    function get_post_key_value_pairs_for_delete_follow_notification_record(notification_id) {
        console.log("Inside METHOD: get_post_key_value_pairs_for_delete_follow_notification_record().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "delete_follow_notification_record=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&notification_id=" + notification_id;


        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);

        console.log("VAR:post_key_value_pairs: " + post_key_value_pairs);
        return post_key_value_pairs;
    }
</script>