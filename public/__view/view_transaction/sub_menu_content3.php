<?php
// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_address.php");    ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_shipping.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>










<?php
// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>











<?php
// TODO: SECTION: Meat
// For payment_preparation=0.
if (isset($_GET["payment_preparation"]) && $_GET["payment_preparation"] == 0) {
    MyDebugMessenger::add_debug_message("There was some problem with your payment preparation. Sorry.");
}


// For payment_validation_success=0.
if (isset($_GET["payment_validation_success"]) && $_GET["payment_validation_success"] == 0) {
    MyDebugMessenger::add_debug_message("There was some problem with your payment validation. Sorry.");
}


// For payment_result.
if (isset($_GET["payment_result"])) {
    // For payment_result=0.
    if ($_GET["payment_result"] == 0) {
        MyDebugMessenger::add_debug_message("There was some problem with your payment transaction. Sorry.");
    }

    // For payment_result=1.
    else if ($_GET["payment_result"] == 1) {
        MyDebugMessenger::add_debug_message("Your payment was a success. Thank you!");
        
        //
        MyDebugMessenger::add_debug_message("Your PayPal Transaction Id is: {$session->paypal_transaction_id}.");
        
    }
}
?>



<div class="payment_result">
    <a href="<?php echo LOCAL . '/public/__view/view_store_cart'; ?>">Go to MyCart</a><br>
    <a href="<?php echo LOCAL . '/public/index.php'; ?>">Go to MyWall</a>
</div>










<?php
// TODO: DEBUG
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>












<?php
// TODO: SECTION: Styles
?>
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style> 
    .payment_result a {
        font-size: 80%;
    }
</style>










<?php
// TODO: SECTION: Scripts 
?>
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += "Payment Result";
</script>