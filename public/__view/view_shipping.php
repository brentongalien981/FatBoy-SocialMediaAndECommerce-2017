<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("view_log_in.php");
}
?>





<!--sub-menus nav-->
<!--I'm currently adding this for my store page.-->
<a href="#">Shipping Info</a>
</nav>






<!--Meat-->
<?php
// TODO: NOW: Show shipping form.
?>
<form id = "form_shipping" action="" method = "post">
    <h4>Ship to Address</h4>
    <?php /* Just retain the values even if the page reloads. */
    ?>
    <h6>Street1</h6>                
    <input type="text" name="street1" value="<?php
//    if (isset($_SESSION["ship_to_details"])) {
//        echo "{$_SESSION['ship_to_details']['street1']}";
//    }
    ?>">


    <h6>Street2</h6>
    <input type="text" name="street2" value="<?php
//    if (isset($_SESSION["ship_to_details"])) {
//        echo "{$_SESSION['ship_to_details']['street2']}";
//    }
    ?>">


    <h6>City</h6>
    <input type="text" name="city" value="<?php
//    if (isset($_SESSION["ship_to_details"])) {
//        echo "{$_SESSION['ship_to_details']['city']}";
//    }
    ?>">               


    <h6>State</h6>
    <input type="text" name="state" value="<?php
//    if (isset($_SESSION["ship_to_details"])) {
//        echo "{$_SESSION['ship_to_details']['state']}";
//    }
    ?>">


    <h6>ZIP</h6>
    <input type="text" name="zip" value="<?php
//    if (isset($_SESSION["ship_to_details"])) {
//        echo "{$_SESSION['ship_to_details']['zip']}";
//    }
    ?>"> 


    <h6>Country</h6>
    <select name="country">
        <?php
//// Listing the countries.
//        global $connection;
//
////
//        $query = "SELECT * FROM Country ";
//        $query .= "ORDER BY Name";
//
//
//        $results = mysqli_query($connection, $query);
//        confirm_query($results);
//
//        while ($row = mysqli_fetch_assoc($results)) {
//            echo "<option value='{$row['Code']}'";
//
//            if (isset($_SESSION["ship_to_details"])) {
//                if ($_SESSION['ship_to_details']['country'] == $row['Code']) {
//                    echo "selected";
//                }
//            }
//
//            echo ">{$row['Name']}</option>";
//        }
        ?>
    </select> 
    <br><br>


    <input type="submit" name="set_shipping" value="set shipping">             
</form>
<br><br><br><br>
<hr>









<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    table {
        width: 80%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    form h4 {
        font-size: 90%;
        display: block;
    }

    #form_shipping h6 {
        margin-top: 7px;
        margin-bottom: 0px;
        font-size: 70%;
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / Shipping Info";
</script>





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
