<script>
    // Vars.
    var button_add_work_experience = document.getElementById("button_add_work_experience");
    // This is the template for work form.
    var form_work_experience_template = document.getElementById("form_work_experience_template");
    var work_experiences_container = document.getElementById("work_experiences_container");





    // Tasks.
//    hide_test_work_exp_div();
    read_work_experiences();








    // Event listeners.
    // Add work experience.
    if (button_add_work_experience != null) {
        button_add_work_experience.addEventListener("click", function () {
            show_form_add_work_experience();
            this.style.display = "none";
        });
    }





    // Functions.
//    function hide_test_work_exp_div() {
//        document.getElementById("-69").style.display = "none";
//    }

    function show_form_add_work_experience() {
        var current_form_add_work_experience = form_work_experience_template.cloneNode(true);
        document.getElementById("work").insertBefore(current_form_add_work_experience, work_experiences_container);
        current_form_add_work_experience.id = "form_add_work_experience";
        current_form_add_work_experience.style.display = "block";

        set_ids_of_a_work_experience_form_elements();
        

        // Set the global form_add_work_experience.
        form_add_work_experience = current_form_add_work_experience;


        /* Event listeners for the buttons of this form. */
        var button_cancel_add_work_experience = document.getElementById("button_cancel_add_work_experience0");
        var button_ok_add_work_experience = document.getElementById("button_ok_add_work_experience0");

        // Cancel add work experience.
        button_cancel_add_work_experience.addEventListener("click", function () {
            document.getElementById("work").removeChild(document.getElementById("form_add_work_experience"));
            button_add_work_experience.style.display = "inline";
        });

        // Ok add work experience.
        button_ok_add_work_experience.addEventListener("click", function () {
            //
            add_work_experience();
        });
    }

    function read_work_experiences() {
        console.log("*** Inside METHOD:read_work_experiences(). ***");

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
                    console.log("*** AJAX in method read_work_experiences(). ***");
                    console.log("*** Log before JSON parsing ***");
                    console.log("responseText: " + xhr.responseText.trim());


                    // Try parsing the JSON.
                    var json;

                    try {
                        json = JSON.parse(xhr.responseText.trim());
                    } catch (e) {
                        console.log('ERROR:invalid json');
                        json = null;
                    }


                    // If the JSON has been formatted...
                    if (json != null && json.is_result_ok) {
                        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);

                        show_work_experiences(json);
                    } else {
                        console.log("RESULT:json.is_result_ok: null/false");
                    }


                    // Formatted JSON log.
                    console.log("*** Formatted JSON in METHOD:read_work_experiences(). ***");
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

        xhr.send(get_post_key_value_pairs_for_read());
    }

    function show_work_experiences(json) {
        console.log("*** Inside METHOD:show_work_experiences(). ***");
        var work_experiences_array = json.work_experiences_array;
        var num_of_work_experiences = work_experiences_array.length;


        // Before populating the work_experiences_container with the
        // work_experience_divs, clear first it's previous innerHTML.
        document.getElementById("work_experiences_container").innerHTML = "";


        for (var i = 0; i < num_of_work_experiences; i++) {
            // Get a reference to the work_experience_div_template element and
            // make it an actual work_experience_div element.
            var a_work_experience_div = document.getElementById("a_work_experience_div_template");


            // Change the relevant id's of the elements of that template and
            // the id of that template itself for the manipulation of the DOM.
            var current_work_experience_id = work_experiences_array[i]['id'];
            a_work_experience_div.id = "a_work_experience_div" + current_work_experience_id;
            set_ids_of_a_work_experience_div_elements(current_work_experience_id);


            // Populate the details of that template from the current
            // json-work-experience-object.
            populate_work_details(current_work_experience_id, work_experiences_array[i]);


            // Append that template to the work_experience_container.
            document.getElementById("work_experiences_container").appendChild(a_work_experience_div);
            a_work_experience_div.style.display = "block";


            recreate_the_work_experience_div_template(a_work_experience_div);


            /* Add event listeners. */
            // Add event listener to the a_work_experience_div.
            add_event_listener_to_work_exp_div(a_work_experience_div);
            //
            current_edit_work_button = document.getElementById("work_experience_edit_button" + current_work_experience_id);
            add_event_listener_to_current_edit_work_button(current_edit_work_button);
            //
            current_delete_work_button = document.getElementById("work_experience_delete_button" + current_work_experience_id);
            add_event_listener_to_current_delete_work_button(current_delete_work_button);

        }
    }


    // Populate the details of that template from the current
    // json-work-experience-object.
    function populate_work_details(current_work_experience_id, a_work_experience_obj) {
        document.getElementById("title_company_name" + current_work_experience_id).innerHTML = a_work_experience_obj['company_name'];
        document.getElementById("title_place" + current_work_experience_id).innerHTML = a_work_experience_obj['place'];
        document.getElementById("title_position" + current_work_experience_id).innerHTML = a_work_experience_obj['position'];
        document.getElementById("title_time_frame" + current_work_experience_id).innerHTML = a_work_experience_obj['time_frame'];

        populate_work_descriptions(current_work_experience_id, a_work_experience_obj['work_descriptions']);
    }


    function recreate_the_work_experience_div_template(a_work_experience_div) {
        // Now that that template is appended, it is now an acutal
        // "a_work_experience_div". So to have similar template for
        // the next work_experience, clone that "now-actual-div" to
        // be the new "work_experience_div_template".
        var new_work_experience_div_template = a_work_experience_div.cloneNode(true);
        new_work_experience_div_template.style.display = "none";


        // Now, because the newly cloned "work_experience_div_template" has
        // ids that is specific to that particular work experience, change
        // those to ids that are general, just like how I had the ids named
        // before referencing and populating that original "work_experience_div_template".
        new_work_experience_div_template.id = "a_work_experience_div_template";
        new_work_experience_div_template.childNodes[1].childNodes[1].id = "work_experience_delete_button";
        new_work_experience_div_template.childNodes[1].childNodes[3].id = "work_experience_edit_button";
        new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[1].childNodes[1].childNodes[1].id = "title_company_name";
        new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[1].id = "title_place";
        new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].id = "title_position";
        new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[3].childNodes[3].childNodes[1].id = "title_time_frame";
        new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[5].childNodes[1].childNodes[1].id = "list_work_descriptions";


        // Append the new "work_experience_div_template" to the
        // middle content element.
        document.getElementById("middle_content").appendChild(new_work_experience_div_template);
    }


    // Change the relevant id's of the elements of that template and
    // the id of that template itself for the manipulation of the DOM.
    // For ex, because the default id of the edit button of this work_experience_div is
    // "work_experience_delete_button", this function will change it to "work_experience_delete_button34".
    // 34 being the current_work_experience_id coming from the db (column "id").
    function set_ids_of_a_work_experience_div_elements(current_work_experience_id) {
        document.getElementById("work_experience_delete_button").id = document.getElementById("work_experience_delete_button").id + current_work_experience_id;
        document.getElementById("work_experience_edit_button").id = document.getElementById("work_experience_edit_button").id + current_work_experience_id;
        document.getElementById("title_company_name").id = document.getElementById("title_company_name").id + current_work_experience_id;
        document.getElementById("title_place").id = document.getElementById("title_place").id + current_work_experience_id;
        document.getElementById("title_position").id = document.getElementById("title_position").id + current_work_experience_id;
        document.getElementById("title_time_frame").id = document.getElementById("title_time_frame").id + current_work_experience_id;
        document.getElementById("list_work_descriptions").id = document.getElementById("list_work_descriptions").id + current_work_experience_id;
    }

    function add_event_listener_to_work_exp_div(a_work_exp_div) {

        // Event mouseover.
        a_work_exp_div.addEventListener("mouseover", function (event) {
            // Id of the edit button of that div.
            // this.id.substring(21) for div "a_work_experience_div34" will be 34.
            var edit_button_id = "work_experience_delete_button" + this.id.substring(21);
            var delete_button_id = "work_experience_edit_button" + this.id.substring(21);
            console.log("edit_button_id: " + edit_button_id);

            if (document.getElementById(edit_button_id) == null ||
                    document.getElementById(edit_button_id) == null) {
                return;
            }

            document.getElementById(edit_button_id).style.visibility = "visible";
            document.getElementById(delete_button_id).style.visibility = "visible";
        });

        // Event mouseout.
        a_work_exp_div.addEventListener("mouseout", function (event) {
            // Id of the edit button of that div.
            var edit_button_id = "work_experience_delete_button" + this.id.substring(21);
            var delete_button_id = "work_experience_edit_button" + this.id.substring(21);
//                    console.log("edit_button_id: " + edit_button_id);

            if (document.getElementById(edit_button_id) == null ||
                    document.getElementById(edit_button_id) == null) {
                return;
            }

            document.getElementById(edit_button_id).style.visibility = "hidden";
            document.getElementById(delete_button_id).style.visibility = "hidden";
        });
    }

    function populate_work_descriptions(current_work_experience_id, work_descriptions) {
        // Clear first the values of the <ul> that has been cloned
        // that containes the values of the previous work experience.
        document.getElementById("list_work_descriptions" + current_work_experience_id).innerHTML = "";

        for (var i = 0; i < work_descriptions.length; i++) {
            var a_description_li = document.createElement("li");
            a_description_li.innerHTML = work_descriptions[i];


            // Populate.
            document.getElementById("list_work_descriptions" + current_work_experience_id).appendChild(a_description_li);
        }
    }

    function get_post_key_value_pairs_for_read() {
        //
        var post_key_value_pairs = "read_work_experiences=yes";


        return post_key_value_pairs;
    }
</script>