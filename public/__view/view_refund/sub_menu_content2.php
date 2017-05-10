<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_my_refund.php"); ?>

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
// TODO: SECTION: Meat.
$refund_vars_array = get_refund_vars_array();
?>
<br>
<form id="" action = "<?php echo LOCAL . '/public/__controller/controller_my_refund.php'; ?>" method = "post">
    <h4>Apply for Refund</h4>

    <h6>Invoice Item Id</h6>
    <h6><?php echo $refund_vars_array['invoice_item_id']; ?></h6>

    <h6>Invoice Item Id</h6>
    <input type="text" name="" value="<?php echo $session->refund_invoice_item_id; ?>" disabled="true">

    <h6>Quantity</h6>
    <input type="number" name="" value="<?php echo $session->refund_item_quantity; ?>">

    <br><br>
    <input type="submit" name="apply_for_refund" value="apply for refund">
</form>
<br><br><br><br>
<hr>










<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / Apply for Refund";
</script>