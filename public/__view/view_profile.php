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






<!--Main content.-->
<?php
echo "view_profile.php"
?>

<!--My Address From-->
<h4 id="h4MyAddress">My Address</h4>
<button id="buttonEditAddress" class="buttonAddress" onclick="displayAddressForm()">edit</button>
<button id="buttonDoneEditingAddress" class="buttonAddress" onclick="hideAddressForm()">done</button>
<form id="formAddress" action="../__controller/controller_address.php" method="post">
    <h6>Street1</h6>
    <input type="text" name="street1">


    <h6>Street2</h6>
    <input type="text" name="street2">


    <h6>City</h6>
    <input type="text" name="city">                


    <h6>State</h6>
    <input type="text" name="state">


    <h6>ZIP</h6>
    <input type="text" name="zip">   


    <h6>Country</h6>
    <select name="country_code">
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
    <input type="radio" name="address_type_code" value="1" checked="checked"><label>Residential</label>
    <input type="radio" name="address_type_code" value="2"><label>Business</label><br><br>



    <?php
    // If the actual user is viewing her own account,
    // display the save address button.
    if ($session->is_viewing_own_account()) {
        echo "<input type='submit' name='save_address' value='save address'>";
    }
    ?>                
</form>
<br>
<br>
<br>





<?php
// Form for letting the actual user add her likes.
// If the user is signed-in and actual user is the one viewing her own account,
// then let the actual user add her likes.
if ($session->is_viewing_own_account()) {

    echo "<h4>What do you like?</h4>";
    echo "<form id='formProfile' action='../__controller/controller_like.php' method='post'>";
    echo "<input name='a_new_like' value='' type='text' /><br>";
    echo "<input type='submit' name='add_like' value='add like' />";
    echo "</form>";

    echo "<br><br><br>";
}
?>






<h4>My Likes</h4>

<!-- Display of all user's likes. -->
<?php
//// TODO
//// Sort of, if the account of the user you're trying to view the profile on is set,
//// then display her likes.
//// TODO: Remove this.
//global $connection;
//
//$query = "SELECT * ";
//$query .= "FROM Likes ";
//$query .= "INNER JOIN UsersAndLikes ";
//$query .= "ON Likes.Id = UsersAndLikes.LikeId ";
//$query .= "WHERE UsersAndLikes.UserId = {$_SESSION['user_id']}";
//$results = mysqli_query($connection, $query);
//confirm_query($results);
//
//echo "<table>";
//while ($row = mysqli_fetch_assoc($results)) {
//    echo "<tr>";
//    echo "<td>" . "{$row['Name']}" . "</td>";
//
//    // If the actual user is viewing her own account,
//    // then let her delete her likes.
//    if ($_SESSION["actual_username"] == $_SESSION["username"]) {
//        echo "<td>";
//        echo "<a href='a_like_deletion.php?like_id={$row["LikeId"]}'>delete</a>";
//        echo "</td>";
//    }
//
//    echo "</tr>";
//}
//echo "</table>";
// 
require_once("../__controller/controller_like.php");


// 
$completely_presented_user_likes_array = get_completely_presented_user_likes_array();

//
echo "<table>";

//
foreach ($completely_presented_user_likes_array as $completely_presented_user_like) {
    echo "<tr>";
    echo $completely_presented_user_like;
    echo "</tr>";
}

//
echo "</table>";
?>






<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />
<style>   
    table, td {
        border: none;
        border-collapse: collapse;
    }
    
    td {
        /*vertical-align: bottom;*/
    }
    
    .form_delete_like {
        /*background-color: yellow;*/
        margin: 0;
        padding: 0;
    }
</style>





<!--Scripts-->
<script src="../_scripts/view_profile.js"></script>
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<!--Footer-->
<?php // include_layout_template('footer.php');    ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
