<?php
// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    return;
}
?>


<script>
// Global variables
    var interval_handle;
    var count = 0;
    
    <?php // TODO:REMINDER: Set this to higher value. ?>
    var update_interval = 2000;


    interval_handle = setInterval(display_notification_count, update_interval);







    function display_notification_count() {
        var xhr = new XMLHttpRequest();

        // TODO: Change the file that handles the counting of notifications to a
        // more general one and not this "NotificationFriendshipAjaxHandler.php".
        var url = "<?php echo LOCAL . "/public/__controller/notifications/NotificationFriendshipAjaxHandler.php"; ?>";
        var request_key_value_pairs = "?get_all_notifications_count=yes";
        url += request_key_value_pairs;
        

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');



        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText.trim();
//                // Log before JSON parsing.
//                console.log("*** AJAX in METHOD: display_notification_count(). ***");
//                console.log("*** Log before JSON parsing ***");
//                console.log("response: " + response);



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
//                    console.log("RESULT:json.is_result_ok: null/false");
                } else if (json.is_result_ok) {
                    // Else if it's successful..
                    set_notification_count_element(json.notification_count);
//                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                }



//                // AJAX JSON log.
//                console.log("*** Formatted JSON in METHOD: display_notification_count(). ***");
//                for (var key in json) {
//                    if (json.hasOwnProperty(key)) {
//                        var val = json[key];
//
//                        // Display in the console.
//                        console.log(key + " => " + val);
//
////                            // Display errors in the form.
////                            var error_label = document.getElementById(key);
////                            if (error_label != null) {
////                                error_label.innerHTML = val;
////                            }
//                    }
//                }




            }
        };


        xhr.send();

    }

    function set_notification_count_element(notification_count) {
        if (notification_count == 0) {
            document.getElementById("span_num_of_notifications").style.display = "none";
        } else {
            // Else, the # of new notifications is positive.
            document.getElementById("span_num_of_notifications").style.display = "inline";
            document.getElementById("span_num_of_notifications").innerHTML = notification_count;
        }
    }
</script>