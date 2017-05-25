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
<form id="form_my_refund" action = "<?php echo LOCAL . '/public/__controller/controller_my_refund.php'; ?>" method = "post">
    <h4>Apply for Refund</h4>

    <h6 class="form_labels">Item Name</h6>
    <h5 class="values"><?php echo $refund_vars_array['item_name']; ?></h5>

    <h6 class="form_labels">Invoice #</h6>
    <h5 class="values"><?php echo $refund_vars_array['invoice_id']; ?></h5>   

    <h6 class="form_labels">Seller</h6>
    <h5 class="values"><?php echo $refund_vars_array['seller_user_name']; ?></h5>   

    <h6 class="form_labels">Seller Address</h6>
    <h5 class="values"><?php echo $refund_vars_array['seller_address']; ?></h5>     

    <h6 class="form_labels">Bought Price per Item in USD</h6>
    <h5 class="values">$<?php echo $refund_vars_array['price_per_item']; ?></h5> 

    <h6 class="form_labels">Bought Quantity</h6>
    <h5 class="values"><?php echo $refund_vars_array['bought_quantity'] . " pcs"; ?></h5>     

    <h6 class="form_labels">Invoice Item Id</h6>
    <input type="text" name="" value="<?php echo $session->refund_invoice_item_id; ?>" disabled="true">

    <h6 class="form_labels">Refund Quantity</h6>
    <input type="number" name="refund_item_quantity" min="1" max="<?php echo $refund_vars_array['bought_quantity']; ?>" value="<?php echo $session->refund_item_quantity; ?>">


    <br>
    <input type="hidden" name="bought_quantity" value="<?php echo $refund_vars_array['bought_quantity']; ?>">
    <input type="submit" name="apply_for_refund" class="form_button" value="apply for refund">
</form>










<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    #form_my_refund {
        margin: 30px;
        padding: 30px;
        padding-top: 40px;
        border-radius: 5px;
        background-color: rgb(240, 240,240);
        box-shadow: 5px 5px 5px rgb(150, 150, 150);
    }

    #form_my_refund h4 {
        display: block;
        margin-bottom: 30px;
    }

    #form_my_refund h6 {
        margin-top: 35px;
        margin-bottom: 7px;
        font-size: 12px;
        font-weight: 100;
    }

    #form_my_refund h5 {
        /*margin-top: 15px;*/
        /*margin-bottom: 7px;*/
        font-size: 13px;
        font-weight: 400;
    }

    #form_my_refund input {
        width: 100px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }

    #form_my_refund input.form_button {
        /*margin: 0;*/
        /*width: 60px;*/
        /*border: 1px solid rgb(224, 255, 193);*/
        border: none;
        background-color: rgb(224, 255, 193);
    }

    #form_my_refund input.form_button:hover {
        background-color: rgb(163, 255, 153);
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Apply for Refund / FatBoy";
</script>