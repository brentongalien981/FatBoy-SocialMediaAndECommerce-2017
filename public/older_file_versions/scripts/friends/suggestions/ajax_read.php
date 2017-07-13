<script>
    // Vars


    // Tasks
    show_all_friend_suggestions();


    // Functions
    function show_all_friend_suggestions() {
        var url = "<?php echo LOCAL . "/public/__controller/friends/suggestions/index.php?get_all_friend_suggestions=yes"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: show_all_friend_suggestions(). ***");
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
                    populate_suggested_friends(json.all_suggested_friends);

//                    // Add event listeners.
//                    add_event_listeners_to_follow_buttons();
                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in METHOD: show_all_friend_suggestions(). ***");
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
        xhr.send();
    }

    /**
     * 
     * @param {array} all_suggested_friends
     * @returns {undefined}
     */
    function populate_suggested_friends(all_suggested_friends) {
        //
        var container = document.getElementById("friend_suggestions_tbody");

        for (var j = 0; j < all_suggested_friends.length; j++) {
            //
            var friend_id = all_suggested_friends[j]["user_id"];
            var friend_name = all_suggested_friends[j]["user_name"];
            var pic_src = all_suggested_friends[j]["user_pic_src"];
            var tr = document.createElement("tr");
            var content = "";
            
            
            content += "<td>";
            content += "<img src='<?php echo LOCAL; ?>" + pic_src + "'>";
            content += "</td>";

            content += "<td><h5>";
            content += friend_name;
            content += "</h5>";
            content += "<input id='follow_button" + friend_id + "' type='button' class='form_button follow_buttons' friend_id='" + friend_id + "' friend_name='" + friend_name + "' value='+ follow'>";
            content += "</td>";
            


            tr.innerHTML = content;
            //
            container.appendChild(tr);

            // Add event listener for the current follow button.
            // Listener for creating a follow request (friendship request)
            // notification record.
            var current_follow_button = document.getElementById("follow_button" + friend_id);
            add_listener_to_follow_button(current_follow_button);


        }
    }
</script>