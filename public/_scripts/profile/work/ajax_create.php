<script>
    // Vars.
    var button_add_work_experience = document.getElementById("button_add_work_experience");
    var button_cancel_add_work_experience = document.getElementById("button_cancel_add_work_experience");
    var button_ok_add_work_experience = document.getElementById("button_ok_add_work_experience");
    var form_add_work_experience = document.getElementById("form_add_work_experience");





    // Tasks.





    // Event listeners.
    // Cancel add work experience.
    button_cancel_add_work_experience.addEventListener("click", function () {
        form_add_work_experience.style.display = "none";
        button_add_work_experience.style.display = "inline";
    });

    // Ok add work experience.
    button_ok_add_work_experience.addEventListener("click", function () {
        //
        add_work_experience();
    });







    // Functions.

    // @return: A reference to the loading img element.
    function show_loading_image(a_form) {
        //
        var loading_img_element = document.createElement("div");
        loading_img_element.style.backgroundColor = "rgb(26, 26, 26)";
        loading_img_element.style.width = (a_form.offsetWidth - 40) + "px";
        loading_img_element.style.height = (a_form.offsetHeight - 50) + "px";
        loading_img_element.innerHTML = "<div style='text-align: center;'><img src='<?php echo LOCAL . '/public/_photos/loading1.gif'; ?>' width='150' height='110' style='margin-top: 50px;'></div>";

        // Hide the form table.
//        console.log("a_form.childNodes[1].style.display: " + a_form.childNodes[1].style.display);
        a_form.childNodes[1].style.display = "none";

        // Append the loading div element to the form.
        a_form.appendChild(loading_img_element);



        // This is to match the color of the loading gif.
        a_form.style.backgroundColor = "rgb(26, 26, 26)";

        return loading_img_element;

    }

    function get_post_key_value_pairs_for_create() {
        console.log("Inside METHOD: get_post_key_value_pairs().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);

        //
        var company_name = document.getElementById("company_name").value;
        var place = document.getElementById("place").value;
        var position = document.getElementById("position").value;
        var time_frame = document.getElementById("time_frame").value;
        var work_experience_description1 = document.getElementById("work_experience_description1").value;
        var work_experience_description2 = document.getElementById("work_experience_description2").value;
        var work_experience_description3 = document.getElementById("work_experience_description3").value;

        //
        var post_key_value_pairs = "add_work_experience=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
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

    function add_work_experience() {
        console.log("*** Inside METHOD:add_work_experience(). ***");
        var loading_image = show_loading_image(form_add_work_experience);

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
                        xhr.responseText.trim().length > 0)
                {

                    // Log before JSON parsing.
                    console.log("*** AJAX in method add_work_experience(). ***");
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


                    // If the response is not successful..
                    if (json == null || !json.is_result_ok) {
                        console.log("RESULT:json.is_result_ok: null/false");

                        // Re-show the form table.
                        form_add_work_experience.childNodes[1].style.display = "block";

                        // Change back the color of the form.
                        form_add_work_experience.style.backgroundColor = "rgb(240, 252, 255)";


                        // Show the error mesg.
                        var form_header = form_add_work_experience.childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1];
                        form_header.style.color = "red";
                        form_header.style.fontWeight = "500";
                        form_header.innerHTML = "* Required Fields are missing *";
                    } else if (json.is_result_ok) {
                        // Else if it's successful..
                        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                        
                        
                        // Call from file "ajax_read.php".
                        read_work_experiences();

<?php
// TODO:REMINDER: Maybe replace this with a 
//      JS AJAX code like display_all_work_experiences().
?>
//                        var the_work_exp_main_div = form_add_work_experience.parentElement;
//                        add_work_exp_div(the_work_exp_main_div, json);
//
//
                        // Re-show the form table of inputs.
                        form_add_work_experience.childNodes[1].style.display = "block";

                        // Change back the color of the form.
                        form_add_work_experience.style.backgroundColor = "rgb(240, 252, 255)";
//
//
                        // Re-set the header value of the add work experience form to default.
                        var form_header = form_add_work_experience.childNodes[1].childNodes[1].childNodes[0].childNodes[1].childNodes[1];
                        form_header.style.color = "black";
                        form_header.style.fontWeight = "100";
                        form_header.innerHTML = "Additional Work Experience.";


                        form_add_work_experience.style.display = "none";

                        button_add_work_experience.style.display = "inline";
                    }


                    // AJAX JSON log.
                    console.log("*** Formatted JSON in METHOD:add_work_experience(). ***");
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

                //
                form_add_work_experience.removeChild(loading_image);
            }
        }

        xhr.send(get_post_key_value_pairs_for_create());
    }

    function add_work_exp_div(the_work_exp_main_div, json) {
        // The initially hidden template div now becomes an active work_exp_div.
        var new_work_exp_div = the_work_exp_main_div.childNodes[4];

        // This cloned div off of the initially hidden template will
        // become the next template for others.
        var template_work_exp_div = new_work_exp_div.cloneNode(true);




//            // This jquery doesn't work as I would like it to.
//            $("#-1500").insertAfter("#-69");


        /* Display new_work_exp_div in my way by manipulating the DOM. */
        the_work_exp_main_div.insertBefore(template_work_exp_div, new_work_exp_div);



        // Set the new_work_exp_div attributes.
        new_work_exp_div.id = json.id;

        // Set the id of the edit button of this div.
        new_work_exp_div.childNodes[0].childNodes[0].id = "form_button_delete" + json.id;
        new_work_exp_div.childNodes[0].childNodes[1].id = "form_button_edit" + json.id;

        // Set all the contents of the fields.
        reset_work_exp_div(new_work_exp_div, json);

<?php // TODO:REMINDER:Uncomment these.         ?>
//        // Set the event listener for this div's delete button.
//        add_listeners_to_delete_button_bruh(new_work_exp_div.childNodes[0].childNodes[0]);

<?php // TODO:REMINDER:Uncomment these.         ?>
//        // Set the event listener for this div's edit button.
//        add_listeners_to_edit_button_bruh(new_work_exp_div.childNodes[0].childNodes[1]);


<?php // TODO:REMINDER:Uncomment these.         ?>
//        // Set the event listener of the div.
//        add_event_listeners_to_work_exp_div_bruh(new_work_exp_div);
    }

    function reset_work_exp_div(the_work_exp_div, json) {
        // Set the values of the tds-ish from JSON.
        console.log("json.company_name: " + json.company_name);
        console.log("json.place: " + json.place);
        console.log("json.position: " + json.position);
        console.log("json.time_frame: " + json.time_frame);

        console.log("json.work_experience_description1: " + json.work_experience_description1);
        console.log("json.work_experience_description2: " + json.work_experience_description2);
        console.log("json.work_experience_description3: " + json.work_experience_description3);

        // For the work main details.
        var element_company_name = the_work_exp_div.childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0];
        var element_place = the_work_exp_div.childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0];
        var element_position = the_work_exp_div.childNodes[1].childNodes[0].childNodes[1].childNodes[0].childNodes[0];
        var element_time_frame = the_work_exp_div.childNodes[1].childNodes[0].childNodes[1].childNodes[1].childNodes[0];

        the_work_exp_div.setAttribute('company_name', json.company_name);
        the_work_exp_div.setAttribute('place', json.place);
        the_work_exp_div.setAttribute('position', json.position);
        the_work_exp_div.setAttribute('time_frame', json.time_frame);

        element_company_name.innerHTML = json.company_name;
        element_place.innerHTML = json.place;
        element_position.innerHTML = json.position;
        element_time_frame.innerHTML = json.time_frame;



        /* For the work descriptions. */
        var element_work_experience_description_container = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0];

        var num_of_actual_descriptions = 0;

        var element_work_experience_description1 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[0];
        // If it returned an empty string, then deleted the previous <li>
        // if it existed before update. If it didn't exist before update, then
        // just do nothing.
        if (json.work_experience_description1 == "" || json.work_experience_description1 == null) {
            if (element_work_experience_description1 != null) {
                element_work_experience_description_container.removeChild(element_work_experience_description1);
            }
        } else if (json.work_experience_description1 != null) {
            ++num_of_actual_descriptions;
            // Check if a nth <li> existed before the edit.
            // Otherwise, create a new one.
            if (element_work_experience_description1 != null) {
                element_work_experience_description1.innerHTML = json.work_experience_description1;
            } else {
                element_work_experience_description1 = document.createElement("li")
                element_work_experience_description1.innerHTML = json.work_experience_description1;
                element_work_experience_description_container.appendChild(element_work_experience_description1);
            }
        }



        var element_work_experience_description2 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[1];

        // If it returned an empty string, then deleted the previous <li>
        // if it existed before update. If it didn't exist before update, then
        // just do nothing.
        if (json.work_experience_description2 == "" || json.work_experience_description2 == null) {
            if (element_work_experience_description2 != null) {
                element_work_experience_description_container.removeChild(element_work_experience_description2);
            }
        } else if (json.work_experience_description2 != null) {
            ++num_of_actual_descriptions;
            // Check if a nth <li> existed before the edit.
            // Otherwise, create a new one.
            if (element_work_experience_description2 != null) {
                element_work_experience_description2.innerHTML = json.work_experience_description2;
            } else {
                element_work_experience_description2 = document.createElement("li")
                element_work_experience_description2.innerHTML = json.work_experience_description2;
                element_work_experience_description_container.appendChild(element_work_experience_description2);
            }
        }




        var element_work_experience_description3 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[2];

        // If it returned an empty string, then deleted the previous <li>
        // if it existed before update. If it didn't exist before update, then
        // just do nothing.
        if (json.work_experience_description3 == "" || json.work_experience_description3 == null) {
            if (element_work_experience_description3 != null) {
                element_work_experience_description_container.removeChild(element_work_experience_description3);
            }
        } else if (json.work_experience_description3 != null) {
            ++num_of_actual_descriptions;
            // Check if a nth <li> existed before the edit.
            // Otherwise, create a new one.
            if (element_work_experience_description3 != null) {
                element_work_experience_description3.innerHTML = json.work_experience_description3;
            } else {
                element_work_experience_description3 = document.createElement("li")
                element_work_experience_description3.innerHTML = json.work_experience_description3;
                element_work_experience_description_container.appendChild(element_work_experience_description3);
            }
        }


        // Delete stupid trash <li>.
        for (; ; ) {
            var length = element_work_experience_description_container.childNodes.length;

            if (num_of_actual_descriptions == length) {
                break;
            }

            var trash_element = element_work_experience_description_container.childNodes[length - 1];

            element_work_experience_description_container.removeChild(trash_element);
        }





        //
        the_work_exp_div.style.display = "block";
    }
</script>