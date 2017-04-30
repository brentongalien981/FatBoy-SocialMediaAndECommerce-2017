<?php require_once(PUBLIC_PATH . "/__controller/controller_store_cart.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<!--Meat-->
<?php
// TODO: SECTION: Meat.
echo "<h3>My Shopping History</h3>";
?>












<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_store_cart.css'; ?>" rel="stylesheet" type="text/css" />-->
<style>  
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_store_cart.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / My Shopping History";
</script>

