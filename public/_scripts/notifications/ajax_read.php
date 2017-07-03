<script>
    /**
     * Vars
     */
    var categorical_notification_container_template = document.getElementById("categorical_notification_container_template");



    /**
     * Tasks
     */
    show_all_notifications();
    
    
    

    /**
     * Functions
     */
    function show_all_notifications() {
        get_all_notifications();
    }

    function get_all_notifications() {
        var url = "<?php echo LOCAL . "/public/__controller/notifications/index.php?get_all_notifications=yes"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: get_all_notifications(). ***");
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
                    show_all_suggestions(json);
                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in METHOD: get_all_notifications(). ***");
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
</script>