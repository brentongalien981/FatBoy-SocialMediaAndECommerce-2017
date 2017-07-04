<script>
    // Vars.
    var categorical_notification_container_template = document.getElementById("categorical_notification_container_template");





    // Tasks
    set_template();
    show_all_notifications();





    // Functions
    /**
     * Append the template to the end of the middle content,
     * so that whenever you clone this template, then append the newly
     * created element somewhere before the template, when you do a call to
     * method "document.getElementById()", you'll be referencing the newly
     * created element and not the template.
     */
    function set_template() {
        var middle_content = document.getElementById("middle_content");
        middle_content.appendChild(categorical_notification_container_template);
    }

    function show_all_notifications() {
        var url = "<?php echo LOCAL . "/public/__controller/notifications/index.php?get_all_notifications=yes"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: show_all_notifications(). ***");
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
                    show_categorized_notifications(json);
                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in METHOD: show_all_notifications(). ***");
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
     * @param {string} categorized_notification
     * @param {int} current_category_notifications_num
     * @returns {div} {get_current_notification_container.current_notification_container}
     */
    function get_current_notification_container(categorized_notification, current_category_notifications_num) {
        console.log("******************");
        console.log("Inside METHOD: set_current_notification_container()");

        var current_notification_container = null;

        if (current_category_notifications_num > 0) {
            current_notification_container = categorical_notification_container_template.cloneNode(true);
            current_notification_container.innerHTML = "<h4>" + categorized_notification + " Notifications</h4>";
            current_notification_container.innerHTML += "<hr>";
            current_notification_container.style.display = "block";
        }


        console.log("VAR:current_notification_container: " + current_notification_container);


        return current_notification_container;
    }
    
    
    /**
     * 
     * @returns {String}
     */
    function get_notification_msg_for_friendship(notification_obj) {
        var msg = "{User:" + notification_obj["notifier_user_id"] + "} wants to follow you.";
        return msg;
    }
    

    function get_notification_msg_for_my_shopping(notification_obj) {
        var msg = "{Seller:" + notification_obj["notifier_user_id"] + "}’s Store updated the item {ProductName} you bought to status {StatusName}.";
        return msg;
    }


    /**
     * 
     * @param {element} current_notification_container
     * @param {string} categorized_notification
     * @param {int} current_category_notifications_num
     * @returns {undefined}
     */
    function populate_notification_container(current_notification_container, categorized_notifications, categorized_notification, current_category_notifications_num) {
        var output = "";
        for (var j = 0; j < current_category_notifications_num; j++) {

            output += "<p>";
            
            
            //
            var notification_obj = categorized_notifications[categorized_notification][j];

            switch (categorized_notification) {
                case "friendship":
                    output += get_notification_msg_for_friendship(notification_obj);
                    break;
                case "my_shopping":
                    output += get_notification_msg_for_my_shopping(notification_obj);
                    break;
            }

            output += '</p>';

        }


        //
        current_notification_container.innerHTML += output;
        // Append
        document.getElementById("main_content").appendChild(current_notification_container);
    }

    
    /**
     * @param {obj} json
     * @returns {undefined}     */
    function show_categorized_notifications(json) {

        // For each categorized notification
        for (var categorized_notification in json.categorized_notifications) {
            console.log("*************************");
            console.log("Inside METHOD: show_categorized_notifications()");
            console.log("VAR:categorized_notification: " + categorized_notification);



            var current_category_notifications_num = json.categorized_notifications[categorized_notification].length;
            console.log("VAR:current_category_notifications_num: " + current_category_notifications_num);



            /* Get each notification container. */
            var current_notification_container = get_current_notification_container(categorized_notification, current_category_notifications_num);


            /* Populate each notification container. */
            if (current_notification_container != null) {
                populate_notification_container(current_notification_container, json.categorized_notifications, categorized_notification, current_category_notifications_num);
            }
//            continue;
            //uki
        }
    }
</script>