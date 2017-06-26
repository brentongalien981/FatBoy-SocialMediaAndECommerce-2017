<script>
    /* Vars */





    /* Tasks */




    /* Functions */
    function add_event_listener_to_current_edit_work_button(edit_button) {
        console.log("Inside METHOD: add_event_listener_to_current_edit_work_button().");

        // Event click.
        edit_button.addEventListener("click", function (event) {

            //
            var the_work_exp_div = this.parentElement.parentElement;


            // Hide the work experience.
            the_work_exp_div.style.display = "none";


            // Show the form for editing that work experience
            var form_edit_work_experience = document.getElementById("form_work_experience_template").cloneNode(true);
            work_experiences_container.insertBefore(form_edit_work_experience, the_work_exp_div);

            // Set the ids of this form's child elements.
            var current_work_experience_id = the_work_exp_div.id.substring(21);
            form_edit_work_experience.id = "form_edit_work_experience" + current_work_experience_id;
            set_ids_of_a_work_experience_form_elements(current_work_experience_id)

            // Set the style of this form.
            form_edit_work_experience.classList.add("form_edit_work_experience");
            form_edit_work_experience.style.display = "block";


            // Old eetails of the work experience.
            var old_company_name = document.getElementById("title_company_name" + current_work_experience_id).innerHTML;
            var old_place = document.getElementById("title_place" + current_work_experience_id).innerHTML;
            var old_position = document.getElementById("title_position" + current_work_experience_id).innerHTML;
            var old_time_frame = document.getElementById("title_time_frame" + current_work_experience_id).innerHTML;


            // Get the old values of the work task descriptions.
            var list_work_descriptions = document.getElementById("list_work_descriptions" + current_work_experience_id);
            var num_of_work_descriptions = list_work_descriptions.childNodes.length;
            var old_work_descriptions_array = [];

            for (var i = 0; i < num_of_work_descriptions; i++) {
                old_work_descriptions_array[i] = list_work_descriptions.childNodes[i].innerHTML;
            }



            /* Set the initial values of the edit form. */
            // The element h5 of the edit form.
            var edit_form_h5 = document.getElementById("work_form_title" + current_work_experience_id);
            edit_form_h5.innerHTML = "Editing Work Experience...";

            // The element input of the company name of the edit form.
            var company_name_edit_input = document.getElementById("company_name" + current_work_experience_id);
            company_name_edit_input.value = old_company_name;

            // The element input of the company place of the edit form.
            var place_edit_input = document.getElementById("place" + current_work_experience_id);
            place_edit_input.value = old_place;

            //
            var position_edit_input = document.getElementById("position" + current_work_experience_id);
            position_edit_input.value = old_position;

            //
            var time_frame_edit_input = document.getElementById("time_frame" + current_work_experience_id);
            time_frame_edit_input.value = old_time_frame;


            //
            for (var i = 0; i < num_of_work_descriptions; i++) {
                var current_description_textarea = document.getElementById("work_experience_description" + (i + 1) + current_work_experience_id);
                current_description_textarea.innerHTML = old_work_descriptions_array[i];
            }




            // Set the cancel event of the form_edit_work_experience.
            var the_cancel_button = document.getElementById("button_cancel_edit_work_experience" + current_work_experience_id);
            the_cancel_button.addEventListener("click", function (event) {
//                        window.alert("cancel clicked");
//                        form_edit_work_experience.style.display = "none";
                the_work_exp_div.style.display = "block";
                work_experiences_container.removeChild(form_edit_work_experience);
            });



            // Set the ok event of the form_edit_work_experience.
            var the_ok_button = document.getElementById("button_ok_edit_work_experience" + current_work_experience_id);
            the_ok_button.addEventListener("click", function (event) {
                var updated_work_details_array = [];
                updated_work_details_array["work_experience_id"] = current_work_experience_id;
                updated_work_details_array["company_name"] = company_name_edit_input.value;
                updated_work_details_array["place"] = place_edit_input.value;
                updated_work_details_array["position"] = position_edit_input.value;
                updated_work_details_array["time_frame"] = time_frame_edit_input.value;

                // Default valuse for the work descriptions.
                var max_num_of_work_descriptions = 3;
                for (var i = 0; i < max_num_of_work_descriptions; i++) {
                    updated_work_details_array["description_text" + (i + 1)] = "";
                }

                for (var i = 0; i < max_num_of_work_descriptions; i++) {
                    var current_description_textarea = document.getElementById("work_experience_description" + (i + 1) + current_work_experience_id);
                    updated_work_details_array["description_text" + (i + 1)] = current_description_textarea.value;
                }



                // AJAX.
                update_work_experience(form_edit_work_experience, updated_work_details_array, current_work_experience_id);


//            console.log("***************************");
//            console.log("VAR:old_work_descriptions_array[" + i + "]: " + old_work_descriptions_array[i]);
//            console.log("VAR:old_place: " + old_place);
//            console.log("VAR:old_position: " + old_position);
//            console.log("VAR:old_time_frame: " + old_time_frame);
//                return;//uki
            });

        });

    }

    function update_work_experience(form_edit_work_experience, updated_work_details_array, current_work_experience_id) {
        console.log("*************************");
        console.log("Inside METHOD: update_work_experience()");
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
                    console.log("*** AJAX in method update_work_experience(). ***");
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

                        // Show the error mesg.
                        var form_header = document.getElementById("work_form_title" + current_work_experience_id);
                        form_header.style.color = "red";
                        form_header.style.fontWeight = "500";
                        form_header.innerHTML = "Error on the fields.";
                    } else if (json.is_result_ok) {
                        console.log("VAR:json.is_result_ok: " + json.is_result_ok);

                        // Basically, reload all the work divs.
                        read_work_experiences();
                    }


                    // AJAX JSON log.
                    console.log("*** Formatted JSON in METHOD: update_work_experience(). ***");
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


        // For POST vars.
        xhr.send(get_post_key_value_pairs_for_update(updated_work_details_array));
    }

    function get_post_key_value_pairs_for_update(updated_work_details_array) {
        console.log("Inside METHOD: get_post_key_value_pairs_for_update().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);

        // For POST vars.
        var work_experience_id = updated_work_details_array["work_experience_id"];
        var company_name = updated_work_details_array["company_name"];
        var place = updated_work_details_array["place"];
        var position = updated_work_details_array["position"];
        var time_frame = updated_work_details_array["time_frame"];

        var work_experience_description1 = updated_work_details_array["description_text1"];
        var work_experience_description2 = updated_work_details_array["description_text2"];
        var work_experience_description3 = updated_work_details_array["description_text3"];



        //
        var post_key_value_pairs = "update_work_experience=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&work_experience_id=" + work_experience_id;
        post_key_value_pairs += "&company_name=" + company_name;
        post_key_value_pairs += "&place=" + place;
        post_key_value_pairs += "&position=" + position;
        post_key_value_pairs += "&time_frame=" + time_frame;
        post_key_value_pairs += "&work_experience_description1=" + work_experience_description1;
        post_key_value_pairs += "&work_experience_description2=" + work_experience_description2;
        post_key_value_pairs += "&work_experience_description3=" + work_experience_description3;

        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);


        return post_key_value_pairs;
    }

    function set_ids_of_a_work_experience_form_elements(current_work_experience_id = 0) {
        document.getElementById("work_form_title").id = document.getElementById("work_form_title").id + current_work_experience_id;
        document.getElementById("company_name").id = document.getElementById("company_name").id + current_work_experience_id;
        document.getElementById("place").id = document.getElementById("place").id + current_work_experience_id;
        document.getElementById("position").id = document.getElementById("position").id + current_work_experience_id;
        document.getElementById("time_frame").id = document.getElementById("time_frame").id + current_work_experience_id;
        document.getElementById("work_experience_description1").id = document.getElementById("work_experience_description1").id + current_work_experience_id;
        document.getElementById("work_experience_description2").id = document.getElementById("work_experience_description2").id + current_work_experience_id;
        document.getElementById("work_experience_description3").id = document.getElementById("work_experience_description3").id + current_work_experience_id;

        // If this method is called by the page "ajax_read.php",
        // then the buttons are "add_work_experience"...
        if (current_work_experience_id == 0) {
            document.getElementById("button_ok_add_work_experience").id = "button_ok_add_work_experience" + current_work_experience_id;
            document.getElementById("button_cancel_add_work_experience").id = "button_cancel_add_work_experience" + current_work_experience_id;
        } else {
            document.getElementById("button_ok_add_work_experience").id = "button_ok_edit_work_experience" + current_work_experience_id;
            document.getElementById("button_cancel_add_work_experience").id = "button_cancel_edit_work_experience" + current_work_experience_id;

    }


    }






    /* Event listeners */
</script>