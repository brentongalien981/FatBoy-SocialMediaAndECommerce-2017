<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_profile.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_profile_likes.php"); ?>





<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>





<main id="middle_content">



    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a href="" id="sub_nav_chat_with">Sub-menu A</a>
    </nav>





    <!--Main content.-->
    <?php
    show_user_profile_summary();

    show_work_experience();

    show_contact_info();
    ?>








    <?php require_once(PUBLIC_PATH . "/__view/view_profile_likes.php"); ?>







    <?php
    // TODO: SECTION: Form for adding an address.
    ?>
    <!--<button id="buttonEditAddress" class="buttonAddress" onclick="displayAddressForm()">edit address</button>-->
    <!--<button id="buttonDoneEditingAddress" class="buttonAddress" onclick="hideAddressForm()">done</button>-->
    <form id="formAddress" class="formAddress" action="<?php echo LOCAL . "/public/__controller/controller_address.php"; ?>" method="post">
        <!--<h4 id="h4MyAddress">My Address</h4>-->
        <h4>My Address</h4>

        <h6>Street1</h6>
        <input id="street1" type="text" class="form_text_input" name="street1">
        <label class="error_msg" id="error_street1"></label>


        <h6>Street2</h6>
        <input id="street2" type="text" class="form_text_input" name="street2">
        <label class="error_msg" id="error_street2"></label>


        <h6>City</h6>
        <input id="city" type="text" class="form_text_input" name="city">
        <label class="error_msg" id="error_city"></label>


        <h6>State</h6>
        <input id="state" type="text" class="form_text_input" name="state">
        <label class="error_msg" id="error_state"></label>


        <h6>ZIP</h6>
        <input id="zip" type="text" class="form_text_input" name="zip">
        <label class="error_msg" id="error_zip"></label>


        <h6>Country</h6>
        <select id="country_code" class="form_text_input" name="country_code">
            <?php
            //
            require_once(PUBLIC_PATH . "/__controller/controller_country.php");

            //
            $countries_objects_array = get_countries_objects_array();

            //
            foreach ($countries_objects_array as $country_object) {
                echo "<option value='{$country_object->code}'>{$country_object->name}</option>";
            }
            ?>
        </select>



        <h6>Address Type</h6>
        <input id="residential_address_type_code" class="radio_buttons" type="radio" name="address_type_code" value="1" checked="checked"><label class="label">Residential</label>
        <input id="business_address_type_code" class="radio_buttons" type="radio" name="address_type_code" value="2"><label class="label">Business</label><br><br>
        <label class="error_msg" id="error_address_type_code"></label>

        <input id="form_action_address_button" type='button' class='buttonAddress form_action_address_button' name='form_action_address_button' value='{action} address'>
        <input id="cancel_address_button" type='button' class='buttonAddress' name='cancel' value='cancel'>


        <?php
//        // If the actual user is viewing her own account,
//        // display the save address button.
//        if ($session->is_viewing_own_account()) {
//            echo "<input type='button' class='buttonAddress' name='save_address' value='save address'>";
//        }
        ?>
    </form>







    <?php
// TODO: SECTION: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>







<?php
// TODO: SECTION: Styles.
?>
<link href="<?php echo LOCAL . "/public/_styles/profile/main.css"; ?>" rel="stylesheet" type="text/css">





<?php
// TODO: SECTION: Scripts.
?>

<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Profile / FatBoy";
</script>











<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>












<script>
    window.onload = function () {

//        var form_edit_work_experience = form_add_work_experience.cloneNode(true);
//        puta();


//        // Add work experience.
//        if (button_add_work_experience != null) {
//            button_add_work_experience.addEventListener("click", function () {
//                show_form_add_work_experience();
//                this.style.display = "none";
//            });
//        }


//        // Cancel add work experience.
//        button_cancel_add_work_experience.addEventListener("click", function () {
//            form_add_work_experience.style.display = "none";
//            button_add_work_experience.style.display = "inline";
//        });

        // Ok add work experience.
        button_ok_add_work_experience.addEventListener("click", function () {
            // TODO: REMINDER: Show spinner.


            //
            add_work_experience();
        });


        // Make the edit button visible if a div of a work experience is hovered.
        add_event_listeners_to_work_exp_divs();

        //
        add_event_listeners_to_delete_work_buttons();

        //
        add_event_listeners_to_edit_work_buttons();


        //uki
        hide_test_work_exp_div();


        //
        populate_address();


    };


    var form_add_work_experience = document.getElementById("form_add_work_experience");
    var button_add_work_experience = document.getElementById("button_add_work_experience");
    var button_ok_add_work_experience = document.getElementById("button_ok_add_work_experience");
    var button_cancel_add_work_experience = document.getElementById("button_cancel_add_work_experience");
    var form_add_work_experience_loading_image = null;

    // This var will be used for adding and editing
    // the currently manipulated address.
    var currently_edited_address_id = -69;
    var current_address_form = null;

    function populate_address() {
        console.log("Inside method populate_address().");

        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . "/public/__controller/controller_address.php"; ?>";

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


        // Vars.
        var address_details = document.createElement("h5");
        var contact_info_table = document.getElementById("contact_info");


        // Populate the address_tr with 3 <td>s.
        var address_tr = contact_info_table.childNodes[0].childNodes[0];
        address_tr.innerHTML = "<td><h5>Address</h5></td>";
        address_tr.innerHTML += "<td class='contact_details'></td>";
        address_tr.innerHTML += "<td></td>";


        var address_td = contact_info_table.childNodes[0].childNodes[0].childNodes[1];
        var has_address = "no";

        xhr.onreadystatechange = function () {
            // If there's a successful response..
            if (xhr.readyState == 4 &&
                    xhr.status == 200 &&
                    xhr.responseText.trim().length > 0) {

                // LOG
                console.log("LOG: xhr.responseText.trim(): " + xhr.responseText.trim());




                if (xhr.responseText.trim() == "0") {
                    address_details.innerHTML = "n/a";
                } else {
                    has_address = "yes";
                    console.log("SUCCESS AJAX response for method populate_address()");

                    var address_obj_json = JSON.parse(xhr.responseText.trim());
                    console.log("VAR address_obj_json: " + address_obj_json);

                    // Adderess details.
                    address_details.innerHTML = address_obj_json.street1;
                    if (address_obj_json.street2 != "") {
                        address_details.innerHTML += ", " + address_obj_json.street2;
                    }
                    address_details.innerHTML += ", " + address_obj_json.city + ",<br>";
                    address_details.innerHTML += address_obj_json.state;
                    address_details.innerHTML += ", " + address_obj_json.zip;
                    address_details.innerHTML += ", " + address_obj_json.country_code;
                    if (address_obj_json.phone != "") {
                        address_details.innerHTML += ",<br>" + address_obj_json.phone;
                    }

                    //
                    currently_edited_address_id = address_obj_json.id;
                }




                // Append the details to address row.
                address_td.appendChild(address_details);

                show_address_button(has_address);
            }
        }



        //
        var post_key_value_pairs = "populate_address=yes";
//            post_key_value_pairs += "&company_name=" + company_name;
        xhr.send(post_key_value_pairs);
    }

    function show_address_button(has_address) {
        console.log("Inside method show_address_button().");

        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . "/public/__controller/controller_address.php"; ?>";

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


        // Vars.
        var contact_info_table = document.getElementById("contact_info");
        var address_button_td = contact_info_table.childNodes[0].childNodes[0].childNodes[2];

        xhr.onreadystatechange = function () {
            // If there's a successful response..
            if (xhr.readyState == 4 &&
                    xhr.status == 200 &&
                    xhr.responseText.trim().length > 0) {

                if (xhr.responseText.trim() == "0") {
                    address_button_td.innerHTML = "";
                } else {
                    address_button_td.innerHTML = xhr.responseText.trim();
                }


                set_address_action_button_event_listener();
            }
        }



        //
        var post_key_value_pairs = "show_address_button=yes";
        post_key_value_pairs += "&has_address=" + has_address;
        xhr.send(post_key_value_pairs);
    }


    function set_address_action_button_event_listener() {

        //uki
        var address_action_button = document.getElementsByClassName("address_action_button");

        for (var i = 0; i < address_action_button.length; i++) {
            address_action_button[i].addEventListener("click", function () {
                var action = this.getAttribute("myAction");
                if (action == "add") {
                    show_add_address_form();
                } else if (action == "edit") {
                    show_edit_address_form();
                }

            });
        }
    }

    

    function show_edit_address_form() {
        console.log("Inside method: show_edit_address_form().");

        // Clone the formAddress.
        var form_address_template = document.getElementById("formAddress");
        var the_edit_address_form = form_address_template.cloneNode(true);
        current_address_form = the_edit_address_form;

        // Change the the_add_address_form's id and style
        // to avoid conflict with the cloned from form.
        the_edit_address_form.id = "the_edit_address_form";
        the_edit_address_form.style.display = "block";


        // Display the formAddress.
        display_form_address(the_edit_address_form);

        // TODO:REMINDER: Make the appropriate edit on the ids and values of these buttons
        //                on function show_add_address_form() and resurrect()...
        var edit_address_button = document.getElementById("form_action_address_button");
        var cancel_button = document.getElementById("cancel_address_button");

        // Change the value of the action_addres_button.
        document.getElementsByClassName("form_action_address_button")[0].value = "edit address";

        edit_address_button.addEventListener("click", function (event) {
//                window.alert("puta");
            edit_address(the_edit_address_form);
        });

        cancel_button.addEventListener("click", function (event) {
            resurrect_form_address(current_address_form);
            populate_address();
        });


        // Remove the form_address_template to avoid conflict with the inputs's ids
        // when POSTing.
        form_address_template.parentElement.removeChild(form_address_template);
    }

    function show_add_address_form() {
        console.log("Inside method: show_add_address_form().");

        // Clone the formAddress.
        var form_address_template = document.getElementById("formAddress");
        var the_add_address_form = form_address_template.cloneNode(true);
        current_address_form = the_add_address_form;

        // Change the the_add_address_form's id and style
        // to avoid conflict with the cloned from form.
        the_add_address_form.id = "the_add_address_form";
        the_add_address_form.style.display = "block";


        // Display the formAddress.
        display_form_address(the_add_address_form);

        // Change the value of the action_addres_button.
        document.getElementsByClassName("form_action_address_button")[0].value = "save address";


        //
        var save_address_button = document.getElementById("form_action_address_button");
        var cancel_button = document.getElementById("cancel_address_button");

        save_address_button.addEventListener("click", function (event) {
            add_address(the_add_address_form);
        });

        cancel_button.addEventListener("click", function (event) {
            resurrect_form_address(current_address_form);
            populate_address();
        });


        // Remove the form_address_template to avoid the inputs's ids
        // when POSTing.
        form_address_template.parentElement.removeChild(form_address_template);
    }


    function remove_form(the_form) {
        the_form.parentElement.removeChild(the_form);

    }

    function edit_address(the_edit_address_form) {
        console.log("Inside method edit_address().");

        var xhr = new XMLHttpRequest();

        var url = the_edit_address_form.getAttribute("action");

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If there's a successful response..
            if (xhr.readyState == 4 &&
                    xhr.status == 200 &&
                    xhr.responseText.trim().length > 0)
            {

                // Log before JSON parsing.
                console.log("*** Log before JSON parsing ***");
                console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


                //
                var json = JSON.parse(xhr.responseText.trim());


                if (json.is_address_ok) {
                    // 
                    console.log("SUCCESS AJAX for method add_address().");


                    // Resurrect the formAddres.
                    var form_address_template = the_edit_address_form.cloneNode(true);
                    resurrect_form_address(form_address_template);


                    // Remove the_add_address_form.
                    remove_form(the_edit_address_form);

                    // 
                    populate_address();
                } else {
                    // 
                    console.log("FAIL AJAX for method add_address().");
                }

                // AJAX JSON log.
                console.log("*** AJAX JSON log Formatted ***");
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        var val = json[key];

                        // Display in the console.
                        console.log(key + " => " + val);

                        // Display in the form.
                        var error_label = document.getElementById(key);
                        if (error_label != null) {
                            error_label.innerHTML = val;
                        }

                    }
                }
            }

        }




        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = document.createElement("input");
        input_csrf_token.id = "input_csrf_token";
        input_csrf_token.setAttribute("type", "hidden");
        input_csrf_token.setAttribute("value", get_csrf_token());

        // Dynamically append a hidden csrf input to the form "create_post_form".
        the_edit_address_form.appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "edit_address=yes";
        post_key_value_pairs += "&address_id=" + currently_edited_address_id;
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&street1=" + document.getElementById("street1").value;
        post_key_value_pairs += "&street2=" + document.getElementById("street2").value;
        post_key_value_pairs += "&city=" + document.getElementById("city").value;
        post_key_value_pairs += "&state=" + document.getElementById("state").value;
        post_key_value_pairs += "&zip=" + document.getElementById("zip").value;
        post_key_value_pairs += "&country_code=" + document.getElementById("country_code").value;

        if (document.getElementById("residential_address_type_code").checked) {
            post_key_value_pairs += "&address_type_code=" + document.getElementById("residential_address_type_code").value;
        } else {
            post_key_value_pairs += "&address_type_code=" + document.getElementById("business_address_type_code").value;
        }

        xhr.send(post_key_value_pairs);

        // Right away, remove the hidden csrf input from the form.
        the_edit_address_form.removeChild(input_csrf_token);
    }

    function add_address(the_add_address_form) {
        console.log("Inside method add_address().");

        var xhr = new XMLHttpRequest();

        var url = the_add_address_form.getAttribute("action");

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If there's a successful response..
            if (xhr.readyState == 4 &&
                    xhr.status == 200 &&
                    xhr.responseText.trim().length > 0)
            {

                // Log before JSON parsing.
                console.log("*** Log before JSON parsing ***");
                console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


                //
                var json = JSON.parse(xhr.responseText.trim());


                if (json.is_address_ok) {
                    // 
                    console.log("SUCCESS AJAX for method add_address().");


                    // Resurrect the formAddres.
                    var form_address_template = the_add_address_form.cloneNode(true);
                    resurrect_form_address(form_address_template);


                    // Remove the_add_address_form.
                    remove_form(the_add_address_form);

                    // 
                    populate_address();
                } else {
                    // 
                    console.log("FAIL AJAX for method add_address().");
                }

                // AJAX JSON log.
//                    console.log("xhr.responseText.trim(): " + xhr.responseText.trim());
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        var val = json[key];

                        // Display in the console.
                        console.log(key + " => " + val);

                        // Display in the form.
                        var error_label = document.getElementById(key);
                        if (error_label != null) {
                            error_label.innerHTML = val;
                        }

                    }
                }
            }

        }




        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = document.createElement("input");
        input_csrf_token.id = "input_csrf_token";
        input_csrf_token.setAttribute("type", "hidden");
        input_csrf_token.setAttribute("value", get_csrf_token());

        // Dynamically append a hidden csrf input to the form "create_post_form".
        the_add_address_form.appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "add_address=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&street1=" + document.getElementById("street1").value;
        post_key_value_pairs += "&street2=" + document.getElementById("street2").value;
        post_key_value_pairs += "&city=" + document.getElementById("city").value;
        post_key_value_pairs += "&state=" + document.getElementById("state").value;
        post_key_value_pairs += "&zip=" + document.getElementById("zip").value;
        post_key_value_pairs += "&country_code=" + document.getElementById("country_code").value;

        if (document.getElementById("residential_address_type_code").checked) {
            post_key_value_pairs += "&address_type_code=" + document.getElementById("residential_address_type_code").value;
        } else {
            post_key_value_pairs += "&address_type_code=" + document.getElementById("business_address_type_code").value;
        }

        xhr.send(post_key_value_pairs);

        // Right away, remove the hidden csrf input from the form.
        the_add_address_form.removeChild(input_csrf_token);
    }



    function resurrect_form_address(template_form) {
        // Reset the id of the action_addres_button.
//            document.getElementsByClassName("form_action_address_button")[0].id = "form_action_address_button";
        document.getElementsByClassName("form_action_address_button")[0].value = "{action} address";

        // Change the the_add_address_form's id and style
        // to avoid conflict with the cloned from form.
        template_form.id = "formAddress";
        template_form.style.display = "none";
        document.getElementById("middle_content").appendChild(template_form);
    }



    function display_form_address(the_address_form) {
        // Get the table element "contact_info".
        var the_table = document.getElementById("contact_info");

        // Get the <tr> for the address.
        var the_tr = the_table.childNodes[0].childNodes[0];

        // Remove the_tr's address details row.
        the_tr.innerHTML = "";

        // Create the <td> placeholder for the formAddress.
        the_td = document.createElement("td");
        the_td.appendChild(the_address_form);

        // Append the_td.
        the_tr.appendChild(the_td);
    }


    function hide_test_work_exp_div() {
        document.getElementById("-69").style.display = "none";
    }

    function add_listeners_to_delete_button_bruh(delete_button) {

        // Event click.
        delete_button.addEventListener("click", function (event) {

            // TODO: REMINDER: Do this.
            var is_deletion_sure = window.confirm("Are you sure about \ndeleting this?");

            if (is_deletion_sure) {
                console.log("sure");
                var the_work_exp_div = this.parentElement.parentElement;
                delete_work_experience(the_work_exp_div);
            } else {
                console.log("nont sure");
            }
        });
    }

    function add_listeners_to_edit_button_bruh(edit_button) {

        // Event click.
        edit_button.addEventListener("click", function (event) {

            //
            var the_work_exp_div = this.parentElement.parentElement;

            // Hide the work experience.
            the_work_exp_div.style.display = "none";


            // Show the form for editing that work experienc
            var form_edit_work_experience = form_add_work_experience.cloneNode(true);
            form_edit_work_experience.id = "form_edit_work_experience";
            form_edit_work_experience.classList.add("form_edit_work_experience");
            the_work_exp_div.parentElement.insertBefore(form_edit_work_experience, the_work_exp_div);
            form_edit_work_experience.style.display = "block";

            // Old eetails of the work experience.
//                    console.log("company_name: " + the_work_exp_div.getAttribute("company_name"));
            var old_company_name = the_work_exp_div.getAttribute("company_name");
            var old_place = the_work_exp_div.getAttribute("place");
            var old_position = the_work_exp_div.getAttribute("position");
            var old_time_frame = the_work_exp_div.getAttribute("time_frame");

            // Get the old values of the work task descriptions.
            var task_description1 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[0];
            var task_description2 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[1];
            var task_description3 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[2];

            var old_task_description1 = "";
            var old_task_description2 = "";
            var old_task_description3 = "";

            if (task_description1 != null) {
                old_task_description1 = task_description1.innerHTML;
            }

            if (task_description2 != null) {
                old_task_description2 = task_description2.innerHTML;
            }

            if (task_description3 != null) {
                old_task_description3 = task_description3.innerHTML;
            }




            // Set the initial values of the edit form.
            // The element h5 of the edit form.
            var edit_form_h5 = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0];
//                    console.log("edit_form_h5.innerHTML: " + edit_form_h5.innerHTML);
            edit_form_h5.innerHTML = "Editing Work Experience...";


            // The element input of the company name of the edit form.
            var company_name_edit_input = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[1].childNodes[0].childNodes[0];
            company_name_edit_input.value = old_company_name;


            // The element input of the company place of the edit form.
            var place_edit_input = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[1].childNodes[0].childNodes[1];
            place_edit_input.value = old_place;

            //
            var position_edit_input = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[2].childNodes[0].childNodes[0];
            position_edit_input.value = old_position;

            //
            var time_frame_edit_input = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[2].childNodes[0].childNodes[1];
            time_frame_edit_input.value = old_time_frame;


            // Task descripitons.
            //
            var description_text1 = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[3].childNodes[0].childNodes[0];
            if (old_task_description1 != "") {

                description_text1.value = old_task_description1;
            }

            //
            var description_text2 = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[4].childNodes[0].childNodes[0];
            if (old_task_description2 != "") {

                description_text2.value = old_task_description2;
            }

            //
            var description_text3 = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[5].childNodes[0].childNodes[0];
            if (old_task_description3 != "") {

                description_text3.value = old_task_description3;
            }





            // Set the ok event of the form_edit_work_experience.
            var the_ok_button = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[6].childNodes[0].childNodes[0];
            the_ok_button.id = "button_ok_edit_work_experience" + the_work_exp_div.id;
            the_ok_button.addEventListener("click", function (event) {
                var updated_work_details_array = [];
                updated_work_details_array["work_experience_id"] = the_work_exp_div.id;
                updated_work_details_array["company_name"] = company_name_edit_input.value;
                updated_work_details_array["place"] = place_edit_input.value;
                updated_work_details_array["position"] = position_edit_input.value;
                updated_work_details_array["time_frame"] = time_frame_edit_input.value;

                if (description_text1.value != null && description_text1.value != "") {
                    updated_work_details_array["description_text1"] = description_text1.value;

                }

                if (description_text2.value != null && description_text2.value != "") {
                    updated_work_details_array["description_text2"] = description_text2.value;

                }

                if (description_text3.value != null && description_text3.value != "") {
                    updated_work_details_array["description_text3"] = description_text3.value;

                }




                // AJAX.
                update_work_experience(the_work_exp_div, form_edit_work_experience, updated_work_details_array);
            });

            // Set the cancel event of the form_edit_work_experience.
            var the_cancel_button = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[6].childNodes[0].childNodes[1];
            the_cancel_button.id = "button_cancel_edit_work_experience" + the_work_exp_div.id;
            the_cancel_button.addEventListener("click", function (event) {
//                        window.alert("cancel clicked");
//                        form_edit_work_experience.style.display = "none";
                the_work_exp_div.style.display = "block";
                the_work_exp_div.parentElement.removeChild(form_edit_work_experience);
            });
        });

    }



    function add_event_listeners_to_edit_work_buttons() {
        var edit_work_buttons = document.getElementsByClassName("form_button_edit");
        var num_of_work_exp = edit_work_buttons.length;


        // Start with index 1 instead of 0,
        // cause the 0th <input> with class "form_button_edit"
        // is the template.
        for (var i = 1; i < num_of_work_exp; i++) {
            // Event click.
            add_listeners_to_edit_button_bruh(edit_work_buttons[i]);
        }
    }

    function add_event_listeners_to_delete_work_buttons() {
        var delete_work_buttons = document.getElementsByClassName("form_button_delete");
        var num_of_work_exp = delete_work_buttons.length;


        // Start with index 1 instead of 0,
        // cause the 0th <input> with class "form_button_edit"
        // is the template.
        for (var i = 1; i < num_of_work_exp; i++) {
            // Event click.
            add_listeners_to_delete_button_bruh(delete_work_buttons[i]);
        }
    }

    function add_event_listeners_to_work_exp_div_bruh(work_exp_div) {

        // Event mouseover.
        work_exp_div.addEventListener("mouseover", function (event) {
            // Id of the edit button of that div.
            var edit_button_id = "form_button_edit" + this.id;
            var delete_button_id = "form_button_delete" + this.id;
            console.log("edit_button_id: " + edit_button_id);

            if (document.getElementById(edit_button_id) == null) {
                return;
            }

            document.getElementById(edit_button_id).style.visibility = "visible";
            document.getElementById(delete_button_id).style.visibility = "visible";
        });

        // Event mouseout.
        work_exp_div.addEventListener("mouseout", function (event) {
            // Id of the edit button of that div.
            var edit_button_id = "form_button_edit" + this.id;
            var delete_button_id = "form_button_delete" + this.id;
//                    console.log("edit_button_id: " + edit_button_id);

            if (document.getElementById(edit_button_id) == null) {
                return;
            }

            document.getElementById(edit_button_id).style.visibility = "hidden";
            document.getElementById(delete_button_id).style.visibility = "hidden";
        });
    }


    function add_event_listeners_to_work_exp_divs() {
        var work_exp_divs = document.getElementsByClassName("a_work_experience");
        var num_of_work_exp = work_exp_divs.length;

        for (var i = 1; i < num_of_work_exp; i++) {
            add_event_listeners_to_work_exp_div_bruh(work_exp_divs[i]);

        }


    }

    function show_loading_image(a_form) {
        //
        var loading_img_element = document.createElement("div");
        loading_img_element.style.backgroundColor = "rgb(26, 26, 26)";
        loading_img_element.style.width = (a_form.offsetWidth - 40) + "px";
        loading_img_element.style.height = (a_form.offsetHeight - 50) + "px";
        loading_img_element.innerHTML = "<div style='text-align: center;'><img src='<?php echo LOCAL . '/public/_photos/loading1.gif'; ?>' width='270' height='200' style='margin-top: 50px;'></div>";

        // Hide the form table.
        a_form.childNodes[0].style.display = "none";

        // Append the loading div element to the form.
        a_form.appendChild(loading_img_element);



        // This is to match the color of the loading gif.
        a_form.style.backgroundColor = "rgb(26, 26, 26)";

        return loading_img_element;

    }

//    function reset_work_exp_div(the_work_exp_div, json) {
//        // Set the values of the tds-ish from JSON.
//        console.log("json.company_name: " + json.company_name);
//        console.log("json.place: " + json.place);
//        console.log("json.position: " + json.position);
//        console.log("json.time_frame: " + json.time_frame);
//
//        console.log("json.work_experience_description1: " + json.work_experience_description1);
//        console.log("json.work_experience_description2: " + json.work_experience_description2);
//        console.log("json.work_experience_description3: " + json.work_experience_description3);
//
//        // For the work main details.
//        var element_company_name = the_work_exp_div.childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0];
//        var element_place = the_work_exp_div.childNodes[1].childNodes[0].childNodes[0].childNodes[1].childNodes[0];
//        var element_position = the_work_exp_div.childNodes[1].childNodes[0].childNodes[1].childNodes[0].childNodes[0];
//        var element_time_frame = the_work_exp_div.childNodes[1].childNodes[0].childNodes[1].childNodes[1].childNodes[0];
//
//        the_work_exp_div.setAttribute('company_name', json.company_name);
//        the_work_exp_div.setAttribute('place', json.place);
//        the_work_exp_div.setAttribute('position', json.position);
//        the_work_exp_div.setAttribute('time_frame', json.time_frame);
//
//        element_company_name.innerHTML = json.company_name;
//        element_place.innerHTML = json.place;
//        element_position.innerHTML = json.position;
//        element_time_frame.innerHTML = json.time_frame;
//
//
//
//        /* For the work descriptions. */
//        var element_work_experience_description_container = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0];
//
//        var num_of_actual_descriptions = 0;
//
//        var element_work_experience_description1 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[0];
//        // If it returned an empty string, then deleted the previous <li>
//        // if it existed before update. If it didn't exist before update, then
//        // just do nothing.
//        if (json.work_experience_description1 == "" || json.work_experience_description1 == null) {
//            if (element_work_experience_description1 != null) {
//                element_work_experience_description_container.removeChild(element_work_experience_description1);
//            }
//        } else if (json.work_experience_description1 != null) {
//            ++num_of_actual_descriptions;
//            // Check if a nth <li> existed before the edit.
//            // Otherwise, create a new one.
//            if (element_work_experience_description1 != null) {
//                element_work_experience_description1.innerHTML = json.work_experience_description1;
//            } else {
//                element_work_experience_description1 = document.createElement("li")
//                element_work_experience_description1.innerHTML = json.work_experience_description1;
//                element_work_experience_description_container.appendChild(element_work_experience_description1);
//            }
//        }
//
//
//
//        var element_work_experience_description2 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[1];
//
//        // If it returned an empty string, then deleted the previous <li>
//        // if it existed before update. If it didn't exist before update, then
//        // just do nothing.
//        if (json.work_experience_description2 == "" || json.work_experience_description2 == null) {
//            if (element_work_experience_description2 != null) {
//                element_work_experience_description_container.removeChild(element_work_experience_description2);
//            }
//        } else if (json.work_experience_description2 != null) {
//            ++num_of_actual_descriptions;
//            // Check if a nth <li> existed before the edit.
//            // Otherwise, create a new one.
//            if (element_work_experience_description2 != null) {
//                element_work_experience_description2.innerHTML = json.work_experience_description2;
//            } else {
//                element_work_experience_description2 = document.createElement("li")
//                element_work_experience_description2.innerHTML = json.work_experience_description2;
//                element_work_experience_description_container.appendChild(element_work_experience_description2);
//            }
//        }
//
//
//
//
//        var element_work_experience_description3 = the_work_exp_div.childNodes[1].childNodes[0].childNodes[2].childNodes[0].childNodes[0].childNodes[2];
//
//        // If it returned an empty string, then deleted the previous <li>
//        // if it existed before update. If it didn't exist before update, then
//        // just do nothing.
//        if (json.work_experience_description3 == "" || json.work_experience_description3 == null) {
//            if (element_work_experience_description3 != null) {
//                element_work_experience_description_container.removeChild(element_work_experience_description3);
//            }
//        } else if (json.work_experience_description3 != null) {
//            ++num_of_actual_descriptions;
//            // Check if a nth <li> existed before the edit.
//            // Otherwise, create a new one.
//            if (element_work_experience_description3 != null) {
//                element_work_experience_description3.innerHTML = json.work_experience_description3;
//            } else {
//                element_work_experience_description3 = document.createElement("li")
//                element_work_experience_description3.innerHTML = json.work_experience_description3;
//                element_work_experience_description_container.appendChild(element_work_experience_description3);
//            }
//        }
//
//
//        // Delete stupid trash <li>.
//        for (; ; ) {
//            var length = element_work_experience_description_container.childNodes.length;
//
//            if (num_of_actual_descriptions == length) {
//                break;
//            }
//
//            var trash_element = element_work_experience_description_container.childNodes[length - 1];
//
//            element_work_experience_description_container.removeChild(trash_element);
//        }
//
//
//
//
//
//        //
//        the_work_exp_div.style.display = "block";
//    }


    function show_form_add_work_experience() {

        form_add_work_experience.style.display = "block";
    }

//    function add_work_exp_div(the_work_exp_main_div, json) {
//        // The initially hidden template div now becomes an active work_exp_div.
//        var new_work_exp_div = the_work_exp_main_div.childNodes[4];
//
//        // This cloned div off of the initially hidden template will
//        // become the next template for others.
//        var template_work_exp_div = new_work_exp_div.cloneNode(true);
//
//
//
//
////            // This jquery doesn't work as I would like it to.
////            $("#-1500").insertAfter("#-69");
//
//
//        /* Display new_work_exp_div in my way by manipulating the DOM. */
//        the_work_exp_main_div.insertBefore(template_work_exp_div, new_work_exp_div);
//
//
//
//        // Set the new_work_exp_div attributes.
//        new_work_exp_div.id = json.id;
//
//        // Set the id of the edit button of this div.
//        new_work_exp_div.childNodes[0].childNodes[0].id = "form_button_delete" + json.id;
//        new_work_exp_div.childNodes[0].childNodes[1].id = "form_button_edit" + json.id;
//
//        // Set all the contents of the fields.
//        reset_work_exp_div(new_work_exp_div, json);
//
//        // Set the event listener for this div's delete button.
//        add_listeners_to_delete_button_bruh(new_work_exp_div.childNodes[0].childNodes[0]);
//
//        // Set the event listener for this div's edit button.
//        add_listeners_to_edit_button_bruh(new_work_exp_div.childNodes[0].childNodes[1]);
//
//
//        // Set the event listener of the div.
//        add_event_listeners_to_work_exp_div_bruh(new_work_exp_div);
//    }

    function update_work_experience(the_work_exp_div, form_edit_work_experience, updated_work_details_array) {
        //
        var loading_image = show_loading_image(form_edit_work_experience);


        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__controller/controller_profile.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {

                    if (xhr.responseText.trim() != "0") {
                        console.log("xhr.responseText.trim(): " + xhr.responseText.trim());

//                            //
////                            console.log("AJAX updated_work_details_array[company_name]: " + updated_work_details_array["company_name"]);
//                            console.log("AJAX updated_work_details_array[place]: " + updated_work_details_array["place"]);
//                            console.log("AJAX updated_work_details_array[position]: " + updated_work_details_array["position"]);
//                            console.log("AJAX updated_work_details_array[time_frame]: " + updated_work_details_array["time_frame"]);
//
//                            if (updated_work_details_array["description_text1"] != null &&
//                                    updated_work_details_array["description_text1"] != "") {
//                                console.log("AJAX updated_work_details_array[description_text1]: " + updated_work_details_array["description_text1"]);
//                            }
//
//                            if (updated_work_details_array["description_text2"] != null &&
//                                    updated_work_details_array["description_text2"] != "") {
//                                console.log("AJAX updated_work_details_array[description_text2]: " + updated_work_details_array["description_text2"]);
//                            }
//
//                            if (updated_work_details_array["description_text3"] != null &&
//                                    updated_work_details_array["description_text3"] != "") {
//                                console.log("AJAX updated_work_details_array[description_text3]: " + updated_work_details_array["description_text3"]);
//                            }



                        // If update is successful...
                        var json = JSON.parse(xhr.responseText.trim());

                        reset_work_exp_div(the_work_exp_div, json);
//                            the_work_exp_div.style.display = "block";

                        // Remove the form_edit_work...
                        the_work_exp_div.parentElement.removeChild(form_edit_work_experience);
                    } else {
//                            //
//                             window.alert("Required Fields are missing.");

                        // Remove the loading imag elemetn.
                        form_edit_work_experience.removeChild(loading_image);
//                            loading_image.style.display = "none";


                        // Re-show the form table.
                        form_edit_work_experience.childNodes[0].style.display = "block";

                        // Change back the color of the form.
                        form_edit_work_experience.style.backgroundColor = "rgb(240, 252, 255)";


                        // Show the error mesg.
                        var form_header = form_edit_work_experience.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]
                        form_header.style.color = "red";
                        form_header.style.fontWeight = "500";
                        form_header.innerHTML = "Required Fields are missing.";

                    }

                }

            }
        }



        // For POST vars.
        var work_experience_id = updated_work_details_array["work_experience_id"];
        var company_name = updated_work_details_array["company_name"];
        var place = updated_work_details_array["place"];
        var position = updated_work_details_array["position"];
        var time_frame = updated_work_details_array["time_frame"];



        var work_experience_description1 = "";
        if (updated_work_details_array["description_text1"] != null &&
                updated_work_details_array["description_text1"] != "") {
            work_experience_description1 = updated_work_details_array["description_text1"];
        }

//            var work_experience_description2 = document.getElementById("work_experience_description2").value;
        var work_experience_description2 = "";
        if (updated_work_details_array["description_text2"] != null &&
                updated_work_details_array["description_text2"] != "") {
            work_experience_description2 = updated_work_details_array["description_text2"];
        }


//            var work_experience_description3 = document.getElementById("work_experience_description3").value;
        var work_experience_description3 = "";
        if (updated_work_details_array["description_text3"] != null &&
                updated_work_details_array["description_text3"] != "") {
            work_experience_description3 = updated_work_details_array["description_text3"];
        }


        //
        var post_key_value_pairs = "update_work_experience=yes";
        post_key_value_pairs += "&work_experience_id=" + work_experience_id;
        post_key_value_pairs += "&company_name=" + company_name;
        post_key_value_pairs += "&place=" + place;
        post_key_value_pairs += "&position=" + position;
        post_key_value_pairs += "&time_frame=" + time_frame;
        post_key_value_pairs += "&work_experience_description1=" + work_experience_description1;
        post_key_value_pairs += "&work_experience_description2=" + work_experience_description2;
        post_key_value_pairs += "&work_experience_description3=" + work_experience_description3;

        xhr.send(post_key_value_pairs);
    }

    function delete_work_experience(the_work_exp_div) {
//            var loading_image = show_loading_image(form_add_work_experience);
//            form_add_work_experience_loading_image = loading_image;

        // TODO: DEBUG
        console.log("Insie method delete_work_experience().");
        console.log("the_work_exp_div.id: " + the_work_exp_div.id);


        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__controller/controller_profile.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {

                    if (xhr.responseText.trim() == "1") {
                        // TODO: LOG
                        console.log("SUCCESS db deleteion");
                        console.log("xhr.responseText.trim(): " + xhr.responseText.trim());
                        console.log("the_work_exp_div.id: " + the_work_exp_div.id);


                        // If update is successful...
                        the_work_exp_div.parentElement.removeChild(the_work_exp_div);
                        console.log("SUCCESS removing the_work_exp_div");

                    } else {
                        console.log("FAIL AJAX PHP returned 0.");
                    }

                }

            }


        }

        //
        var post_key_value_pairs = "delete_work_experience=yes";
        post_key_value_pairs += "&work_experience_id=" + the_work_exp_div.id;

        xhr.send(post_key_value_pairs);
    }

    function add_work_experience() {
        var loading_image = show_loading_image(form_add_work_experience);
//            form_add_work_experience_loading_image = loading_image;

        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__controller/controller_profile.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {

                    if (xhr.responseText.trim() != "0") {
                        console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


                        // If update is successful...
                        var json = JSON.parse(xhr.responseText.trim());

                        //
                        var the_work_exp_main_div = form_add_work_experience.parentElement;
                        add_work_exp_div(the_work_exp_main_div, json);


                        // Re-show the form table.
                        form_add_work_experience.childNodes[0].style.display = "block";

                        // Change back the color of the form.
                        form_add_work_experience.style.backgroundColor = "rgb(240, 252, 255)";


                        // Show the error mesg.
                        var form_header = form_add_work_experience.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0];
                        form_header.style.color = "black";
                        form_header.style.fontWeight = "100";
                        form_header.innerHTML = "Additional Work Experience.";


                        form_add_work_experience.style.display = "none";

                        button_add_work_experience.style.display = "inline";
                    } else {
//                            window.alert("Required Fields are missing.");




                        // Re-show the form table.
                        form_add_work_experience.childNodes[0].style.display = "block";

                        // Change back the color of the form.
                        form_add_work_experience.style.backgroundColor = "rgb(240, 252, 255)";


                        // Show the error mesg.
                        var form_header = form_add_work_experience.childNodes[0].childNodes[0].childNodes[0].childNodes[0].childNodes[0]
                        form_header.style.color = "red";
                        form_header.style.fontWeight = "500";
                        form_header.innerHTML = "Required Fields are missing.";
                    }

                }

                //
                form_add_work_experience.removeChild(loading_image);



            }


        }



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
        post_key_value_pairs += "&company_name=" + company_name;
        post_key_value_pairs += "&place=" + place;
        post_key_value_pairs += "&position=" + position;
        post_key_value_pairs += "&time_frame=" + time_frame;
        post_key_value_pairs += "&work_experience_description1=" + work_experience_description1;
        post_key_value_pairs += "&work_experience_description2=" + work_experience_description2;
        post_key_value_pairs += "&work_experience_description3=" + work_experience_description3;

        xhr.send(post_key_value_pairs);
    }
</script>

<script src="<?php echo LOCAL . "/public/_scripts/profile_likes.js"; ?>"></script>











<?php
// TODO: SECTION: Footer.
?>
<?php // include_layout_template('footer.php');    ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
