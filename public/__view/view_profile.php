<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>

<!--File session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_profile.php"); ?>




<!--For app debug messenger initialization.-->
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
    ?>


    <div class="section">
        <!--My Address From-->

        <button id="buttonEditAddress" class="buttonAddress" onclick="displayAddressForm()">edit address</button>
        <button id="buttonDoneEditingAddress" class="buttonAddress" onclick="hideAddressForm()">done</button>
        <form id="formAddress" action="../__controller/controller_address.php" method="post">
            <h4 id="h4MyAddress">My Address</h4>

            <h6>Street1</h6>
            <input type="text" class="form_text_input" name="street1">


            <h6>Street2</h6>
            <input type="text" class="form_text_input" name="street2">


            <h6>City</h6>
            <input type="text" class="form_text_input" name="city">                


            <h6>State</h6>
            <input type="text" class="form_text_input" name="state">


            <h6>ZIP</h6>
            <input type="text" class="form_text_input" name="zip">   


            <h6>Country</h6>
            <select class="form_text_input" name="country_code">
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
            <input class="radio_buttons" type="radio" name="address_type_code" value="1" checked="checked"><label class="label">Residential</label>
            <input class="radio_buttons" type="radio" name="address_type_code" value="2"><label class="label">Business</label><br><br>



            <?php
            // If the actual user is viewing her own account,
            // display the save address button.
            if ($session->is_viewing_own_account()) {
                echo "<input type='submit' class='buttonAddress' name='save_address' value='save address'>";
            }
            ?>                
        </form>
    </div>
    <!--        <br>
            <br>
            <br>-->




    <div class="section">
        <h4>Likes</h4>
        <?php
// Form for letting the actual user add her likes.
// If the user is signed-in and actual user is the one viewing her own account,
// then let the actual user add her likes.
        if ($session->is_viewing_own_account()) {

            echo "<h5>What do you like?</h5>";
            echo "<form id='formProfile' action='" . LOCAL . "/public/__controller/controller_like.php' method='post'>";
            echo "<input class='form_text_input' name='a_new_like' value='' type='text' /><br>";
            echo "<input class='form_button' type='submit' name='add_like' value='add like' />";
            echo "</form>";

            echo "<br><br><br>";
        }
        ?>






        <h4>My Likes</h4>

        <!-- Display of all user's likes. -->
        <?php
        require_once(PUBLIC_PATH . "/__controller/controller_like.php");


// 
        $completely_presented_user_likes_array = get_completely_presented_user_likes_array();

//
        echo "<table id='like_table'>";

//
        foreach ($completely_presented_user_likes_array as $completely_presented_user_like) {
            echo "<tr>";
            echo $completely_presented_user_like;
            echo "</tr>";
        }

//
        echo "</table>";
        ?>
    </div>







    <?php
// TODO: SECTION: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>







<?php
// TODO: SECTION: Styles.
?>
<!--<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />-->
<style> 
    /*    #main_div {
            background-color: beige;
            padding: 30px;
            border-radius: 5px;
            margin-top: 20px;
            padding-bottom: 30px;
        }*/

    #middle_content {
        background-color: rgb(250, 250, 250);
        padding-bottom: 30px;
        color: black;
    }

    #sub_menus_nav {
        background-color: rgb(60, 60, 60);
    }#sub_menus_nav a {
        color: rgb(220, 220, 220);
    }

    #menu_profile {
        /*background-color: rgb(60, 60, 60);*/
        background-color: rgb(250, 250, 250);
    }

    .section {
        background-color: rgb(245, 245, 245);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);

    }

    #div_about_me {
        /*background-color: pink;*/
        margin-top: 20px;
        min-height: 256px;
    }

    #div_about_me img {
        width: 256px;
        height: 256px;
        border-radius: 3px;
        float: left;
        margin: 0;
        margin-right: 15px;
        margin-bottom: 5px;
        padding: 0;
    }

    #div_about_me p {
        font-size: 13px;
        font-weight: 100;
        margin: 0;
        padding: 0;
    }

    /*    #context_sensitive_nav {
            width: 100%;
            background-color: rgba(50, 50, 50, 1.0);
            height: 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            color: rgba(200, 200, 200, 1.0);
            font-size: 11px;
            font-weight: 100;
            padding-top: 8px;
        }
    
        #context_sensitive_nav a {
            background-color: gray;
            margin-left: 30px;
                    padding-top: 3px;
                    padding-bottom: 3px;
            color: rgba(200, 200, 200, 1.0);
        }
    
        #context_sensitive_nav a:hover {
            color: orange;
    
        }*/

    hr {
        height: 1px;
        background-color: rgb(100, 100, 100);
        margin-top: 10px;
    }

    form h4 {
        display: block;
    }

    form {
        margin-top: -15px;
    }


    #h4MyAddress {
        margin-bottom: 20px;
    }

    form h6 {
        margin-top: 15px;
        margin-bottom: 7px;
        font-size: 14px;
    }

    .form_text_input {
        width: 200px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }

    form label {
        font-size: 70%;
        font-weight: 100;
    }

    .radio_buttons {
        margin-right: 10px;
    }

    .label {
        font-size: 13px;
        margin-right: 30px;
    }

    form select {
        margin-bottom: 7px;
    }

    .buttonAddress {
        margin-bottom: 30px;
        margin-top: 20px;
        color: black;
        /*        background-color: rgb(200, 200, 200);*/
        /*background-color: rgba(255, 157, 45, 0.20);*/
        background-color: rgb(224, 255, 193);
        box-shadow: 3px 3px 3px rgb(130, 130, 130);
        /*border: 1px solid;*/
        font-size: 10px;
        font-weight: 100;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
        margin-right: 10px;        
    }

    .buttonAddress:hover {
        background-color: rgba(255, 157, 45, 0.50);
        cursor: pointer; cursor: hand;
    }





    form table, form td, div.a_work_experience table, div.a_work_experience table td {
        border-collapse: collapse;
    }

    div.a_work_experience table {
        /*background-color: aqua;*/
    }

    div.a_work_experience table td {
        padding-bottom: 10px;
        /*background-color: green;*/
    }

    td#td_edit {
        padding: 0;
        /*padding-bottom: -10px;*/
    }


    form.form_work_experience,
    div.a_work_experience {

        margin: 0;
        margin-top: 30px;
        padding: 20px;
        padding-top: 30px;
        padding-bottom: 20px;
        border-radius: 5px;
        /*background-color: rgb(247, 247, 247);*/
        background-color: rgb(240, 252, 255);
        box-shadow: 5px 5px 5px rgb(150, 150, 150);
        display: none;
    }

    form.form_edit_work_experience {
        display: block;
    }

    div.a_work_experience {
        box-shadow: none;
        margin-top: 20px;
        padding-top: 10px;
        background-color: rgb(248, 248, 248);
        display: block;
    }


    form.form_work_experience h5,
    div.a_work_experience h5 {
        font-size: 13px;
        font-weight: 200;
        margin-bottom: 20px;
        color: black;
    }

    div.a_work_experience h5 {
        /*color: black;*/

        /*margin-right: 50px;*/
        /*background-color: bisque;*/
        display: inline;
    }

    div.a_work_experience ul {
        margin-left: 40px;
        /*background-color: pink;*/
        font-size: 12px;
        font-weight: 100;
    }

    div.a_work_experience li {
        width: 520px;
        margin-top: 5px;
        color: black;
        /*background-color: yellow;*/
    }    



    /*    input.form_button_edit,
        input#form_button_edit {
            margin: 0;
            display: none;
            margin-bottom: 20px;
        }*/

    input.form_button_edit {
        position: relative;
        margin: 0;
        left: -55px;
        top: 0px;
        visibility: hidden;
    }

    form.form_work_experience table {
        /*background-color: pink;*/
    }

    form.form_work_experience table td input {
        /*display: inline;*/
        /*background-color: aquamarine;*/
        width: 200px;
        height: 30px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
        margin-bottom: 10px;
        font-size: 12px;
        font-weight: 200;
        border: 1px solid rgb(235, 235, 235);

    }

    input.right_aligned {
        margin-left: 160px;
        text-align: right;
    }

    td.td_right_aligned {
        text-align: right;
    }



    form.form_work_experience table td {
        word-wrap: break-word;

    }

    #h4_work_experience {
        display: inline;
    }

    #container_button_add_work_experience {
        /*display: inline;*/
    }

    button.form_button {
        margin: 0;
        margin-left: 10px;
        /*margin-top: -20px;*/
        /*border-bottom: 10px solid black;*/
        display: inline;
    }

    form.form_work_experience table td textarea.work_experience_description {
        /*background-color: aquamarine;*/
        border-radius: 3px;
        margin-left: 20px;
        margin-bottom: 10px;
        padding: 10px;

        width: 540px;
        max-width: 540px;
        height: 60px;
        max-height: 60px;
        word-wrap: break-word;
        white-space: pre-line;

        font-size: 11px;
        font-weight: 100;
        border: 1px solid rgb(235, 235, 235);
    }

    form.form_work_experience table td input.form_button {
        /*background-color: aquamarine;*/
        margin: 0;
        margin-right: 10px;
        /*max-width: fit-content;*/
        /*widows:*/ 
        /*height: fit-content;*/
        width: 50px;
        height: 25px;
        font-size: 10px;
        font-weight: 100;
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;

    }



    /*    .form_button {
            margin-bottom: 30px;
            margin-top: 20px;
            color: black;
                    background-color: rgb(200, 200, 200);
            background-color: rgba(255, 157, 45, 0.20);
            box-shadow: 3px 3px 3px rgb(130, 130, 130);
            border: 1px solid;
            font-size: 10px;
            font-weight: 100;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 3px;
            margin-right: 10px;        
        }*/

    /*    .form_button:hover {
            background-color: rgba(255, 157, 45, 0.50);
            cursor: pointer; cursor: hand;
        }*/

    .like_name {
        font-size: 13px;
        font-weight: 100;
        color: black;
        /*background-color: red;*/
    }

    #buttonDoneEditingAddress {
        display: none;
    }

    #formAddress {
        display: none;
        /*visibility: visible;*/
        /*display:*/ 
    }

    .form_delete_like {
        display: inlline;
    }  

    #like_table {
        margin-top: 20px;
    }


    #like_table, like_table td {
        border: none;
        border-collapse: collapse;
    }

    #like_table td {
        /*vertical-align: bottom;*/
        /*background-color: yellow;*/
        padding: 5px;
        padding-left: 0;
        vertical-align: middle;
    }

    #like_table td input {
        margin: 0;
        /*padding: 0;*/
    }

    .form_delete_like {
        /*background-color: yellow;*/
        margin: 0;
        padding: 0;
    }
</style>





<?php
// TODO: SECTION: Scripts.
?>
<script src="<?php echo LOCAL . "/public/_scripts/view_profile.js"; ?>"></script>
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
        var form_add_work_experience = document.getElementById("form_add_work_experience");
        var button_add_work_experience = document.getElementById("button_add_work_experience");
        var button_ok_add_work_experience = document.getElementById("button_ok_add_work_experience");
        var button_cancel_add_work_experience = document.getElementById("button_cancel_add_work_experience");

//        var form_edit_work_experience = form_add_work_experience.cloneNode(true);

        // Add work experience.
        button_add_work_experience.addEventListener("click", function () {
            show_form_add_work_experience();
            this.style.display = "none";
        });


        // Cancel add work experience.
        button_cancel_add_work_experience.addEventListener("click", function () {
            form_add_work_experience.style.display = "none";
            button_add_work_experience.style.display = "inline";
        });

        // Ok add work experience.
        button_ok_add_work_experience.addEventListener("click", function () {
            // TODO: REMINDER: Show spinner.


            //
            add_work_experience();
        });


        // Make the edit button visible if a div of a work experience is hovered.
        add_event_listeners_to_work_exp_divs();

        //
        add_event_listeners_to_edit_work_buttons();



        function add_event_listeners_to_edit_work_buttons() {
            var edit_work_buttons = document.getElementsByClassName("form_button_edit");
            var num_of_work_exp = edit_work_buttons.length;

            for (var i = 0; i < num_of_work_exp; i++) {
                // Event click.
                edit_work_buttons[i].addEventListener("click", function (event) {

                    //
                    var the_work_exp_div = this.parentElement;

                    // Hide the work experience.
                    the_work_exp_div.style.display = "none";


                    // Show the form for editing that work experienc
                    var form_edit_work_experience = form_add_work_experience.cloneNode(true);
                    form_edit_work_experience.classList.add("form_edit_work_experience");
                    the_work_exp_div.parentElement.insertBefore(form_edit_work_experience, the_work_exp_div);

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
                        update_work_experience(form_edit_work_experience, updated_work_details_array);
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
        }


        function add_event_listeners_to_work_exp_divs() {
            var work_exp_divs = document.getElementsByClassName("a_work_experience");
            var num_of_work_exp = work_exp_divs.length;

            for (var i = 0; i < num_of_work_exp; i++) {
                // Event mouseover.
                work_exp_divs[i].addEventListener("mouseover", function (event) {
                    // Id of the edit button of that div.
                    var edit_button_id = "form_button_edit" + this.id;
                    console.log("edit_button_id: " + edit_button_id);

                    document.getElementById(edit_button_id).style.visibility = "visible";
                });

                // Event mouseout.
                work_exp_divs[i].addEventListener("mouseout", function (event) {
                    // Id of the edit button of that div.
                    var edit_button_id = "form_button_edit" + this.id;
//                    console.log("edit_button_id: " + edit_button_id);

                    document.getElementById(edit_button_id).style.visibility = "hidden";
                });
            }


        }


        function show_form_add_work_experience() {

            form_add_work_experience.style.display = "block";
        }

        function update_work_experience(form_edit_work_experience, updated_work_details_array) {
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



//                            // If update is successful...
//                            the_work_exp_div.style.display = "block";
//                            the_work_exp_div.parentElement.removeChild(form_edit_work_experience);
                        } else {
                            window.alert("Required Fields are missing.");
                        }

                    }

                }
            }



//            //
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

        function add_work_experience() {
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

                            form_add_work_experience.style.display = "none";

                            button_add_work_experience.style.display = "inline";
                        } else {
                            window.alert("Required Fields are missing.");
                        }

                    }

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
    };
</script>








<?php
// TODO: SECTION: Footer.
?>
<?php // include_layout_template('footer.php');    ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
