<script>
    // Vars





    // Tasks





    // Functions


    function add_event_listeners_to_accept_follow_request_links() {
        var accept_follow_request_links = document.getElementsByClassName("accept_follow_request_links");

        var length = accept_follow_request_links.length;

        for (var i = 0; i < length; i++) {
            add_event_listener_to_a_follow_request_link(accept_follow_request_links[i])
        }
    }


    function add_event_listener_to_a_follow_request_link(link) {
        link.addEventListener("click", function () {
            console.log("EVENT:CLICK: from METHOD: add_event_listeners_to_a_follow_request_link().");
            
            var friend_id = link.getAttribute("friend_id");
            accept_follow_request(friend_id);
        });

    }




    function create_follow_acceptance_notification_record() {
        var url = "<?php echo LOCAL . "/public/__controller/notifications/index.php"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: create_follow_acceptance_notification_record(). ***");
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
                console.log("*** Formatted JSON in METHOD: create_follow_acceptance_notification_record(). ***");
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


        //
        xhr.send(get_post_key_value_pairs_for_create_follow_acceptance_notification());
    }

    function accept_follow_request(friend_id) {
        // Sort of like a create_friendsip_recrod().
        bridge_create_follow_record(friend_id);
        
        //
        create_follow_acceptance_notification_record();
    }


    function get_post_key_value_pairs_for_create_follow_acceptance_notification() {
        console.log("Inside METHOD: get_post_key_value_pairs_for_create_follow_acceptance_notification().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "create_follow_acceptance_notification=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
//        post_key_value_pairs += "&friend_id=" + friend_id;


        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);

        console.log("VAR:post_key_value_pairs: " + post_key_value_pairs);
        return post_key_value_pairs;
    }
</script>