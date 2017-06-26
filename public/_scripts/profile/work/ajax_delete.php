<script>
    /* Vars */





    /* Tasks */




    /* Functions */
    function add_event_listener_to_current_delete_work_button(delete_button) {

        // Event click.
        delete_button.addEventListener("click", function (event) {

            // TODO: REMINDER: Do this.
            var is_deletion_sure = window.confirm("Are you sure about \ndeleting this?");

            if (is_deletion_sure) {
                console.log("ACTION:DELETE: sure");
                var the_work_exp_div = this.parentElement.parentElement;
                delete_work_experience(the_work_exp_div);
            } else {
                console.log("ACTION:DELETE: nont sure");
            }
        });
    }


    function delete_work_experience(the_work_exp_div) {
        console.log("Insie METHOD: delete_work_experience().");
        console.log("the_work_exp_div.id: " + the_work_exp_div.id);


        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__controller/profile/work/index.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.readyState == 4 &&
                        xhr.status == 200 &&
                        xhr.responseText.trim().length > 0) {

                    // Log before JSON parsing.
                    console.log("*** AJAX in method delete_work_experience(). ***");
                    console.log("*** Log before JSON parsing ***");
                    console.log("responseText: " + xhr.responseText.trim());


                    //
                    var json = null;

                    try
                    {
                        json = JSON.parse(xhr.responseText.trim());
                    } catch (e)
                    {
                        console.log('ERROR:invalid json');
                        json = null;
                    }



                    // New way of doing things.
                    // If the response is not successful..
                    if (json == null || !json.is_result_ok) {
                        console.log("VAR:json.is_result_ok: null/false");
                    } else if (json.is_result_ok) {
                        console.log("VAR:json.is_result_ok: " + json.is_result_ok);
                        work_experiences_container.removeChild(the_work_exp_div);
                    }


                    // AJAX JSON log.
                    console.log("*** Formatted JSON in METHOD: delete_work_experience(). ***");
                    for (var key in json) {
                        if (json.hasOwnProperty(key)) {
                            var val = json[key];

                            // Display in the console.
                            console.log(key + " => " + val);
                        }
                    }
                }

            }
        }

        //
        xhr.send(get_post_key_value_pairs_for_delete(the_work_exp_div));
    }

    function get_post_key_value_pairs_for_delete(the_work_exp_div) {
        console.log("Inside METHOD: get_post_key_value_pairs_for_delete().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);

        // For POST vars.
        var post_key_value_pairs = "delete_work_experience=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&work_experience_id=" + the_work_exp_div.id.substring(21);

        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);


        return post_key_value_pairs;
    }






    /* Event listeners */
</script>