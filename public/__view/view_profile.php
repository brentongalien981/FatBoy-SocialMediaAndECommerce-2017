<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>

<!--File session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_like.php"); ?>




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
        <a id="tae" href="#">Sub-menu1</a>
        <a href="#">Sub-menu2</a>
    </nav>

    <div id="main_div">
        <div id="context_sensitive_nav">
            <a href="#">Address</a>
            <a>&gt;</a>
            <a href="#">Edit Address</a>
        </div>





        <!--Main content.-->
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
    </div>
</main>







<?php
// TODO: SECTION: Styles.
?>
<!--<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />-->
<style> 
    #main_div {
        background-color: beige;
        /*padding: 30px;*/
        border-radius: 5px;
        margin-top: 20px;
        padding-bottom: 30px;
    }

    .section {
        background-color: rgba(240, 240, 240, 1.0);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);

    }

    #context_sensitive_nav {
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
        /*background-color: gray;*/
        margin-left: 30px;
        /*        padding-top: 3px;
                padding-bottom: 3px;*/
        color: rgba(200, 200, 200, 1.0);
    }

    #context_sensitive_nav a:hover {
        color: orange;
        
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
    }

    .buttonAddress:hover {
        background-color: rgba(255, 157, 45, 0.50);
        cursor: pointer; cursor: hand;
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
<script src="../_scripts/view_profile.js"></script>
<script>
                // Edit the page title.
                document.getElementById("title").innerHTML += "Profile / FatBoy";
</script>











<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>








<?php
// TODO: SECTION: Footer.
?>
<?php // include_layout_template('footer.php');    ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
