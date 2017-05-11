<!--Imports-->
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_ad.php"); ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php
// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<!--Meat-->
<?php
echo "<h3>Produce Ad</h3>";
?>

<form id="" action = "<?php echo LOCAL . '/public/__controller/controller_ad.php';  ?>" method = "post">
    <h4>Ad Details</h4>
    

    <h6 class="form_labels">Ad Name</h6>
    <input type="text" name="ad_name" value="<?php echo "{$session->ad_name}"; ?>">
    
    <?php 
    // VIEWWABLE
//    <iframe src="https://drive.google.com/file/d/0B10DknwLh12RV3lLcDdmTnY2ZHM/preview" 
//            width="640" height="480"></iframe>
//            
//    https://drive.google.com/file/d/0B10DknwLh12RV3lLcDdmTnY2ZHM/view?usp=sharing
    
//    <iframe src="https://drive.google.com/file/d/0B10DknwLh12RVHMtd1dOWk14OVk/preview" 
//    width="640" height="480"></iframe>
    
//    <iframe src="https://drive.google.com/file/d/0B10DknwLh12RVHMtd1dOWk14OVk/preview" 
//    width="640" height="480"></iframe>
    ?>

    <h6 class="form_labels">Photo Address</h6>
    <input type="text" name="ad_photo_url_address" value="<?php echo "{$session->ad_photo_url_address}"; ?>">

    <h6 class="form_labels">Description</h6>
    <input type="text" name="ad_description" value="<?php echo "{$session->ad_description}"; ?>">  

    <h6 class="form_labels">Target Number of Airings</h6>
    <input type="number" name="ad_target_num_airings" min="1" max="9999999999999" value="<?php echo "{$session->ad_target_num_airings}"; ?>">    

    <h6 class="form_labels">Budget in USD</h6>
    <input type="number" name="ad_budget" min="0.01" step="0.01" max="9999999999999" value="<?php echo "{$session->ad_budget}"; ?>">

    <h6 class="form_labels">Air Time in seconds</h6>
    <input type="number" name="ad_air_time" min="1" value="<?php echo "{$session->ad_air_time}"; ?>">   

    <br><br>
    <input type="submit" name="produce_ad" value="produce">
</form>











<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    form h6 {
        margin-bottom: 0px;
        font-weight: 200;
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += "FatBoy / Produce Ad";
</script>