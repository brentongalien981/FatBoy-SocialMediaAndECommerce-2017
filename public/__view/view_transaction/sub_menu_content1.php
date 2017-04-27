<!--Imports-->
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
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










<!--Meat-->
<?php
?>

<?php
// TODO: DONE: Show shipping details form.
?>
<form id = "form_shipping" action = "<?php echo LOCAL . '/public/__controller/controller_shipping.php'; ?>" method = "post">
    <h4>Ship to Address</h4>

    <h6>Street1</h6>                
    <input type="text" name="street1" value="<?php echo $session->ship_to_address_street1; ?>">

    <h6>Street2</h6>
    <input type="text" name="street2" value="<?php echo $session->ship_to_address_street2; ?>">

    <h6>City</h6>
    <input type="text" name="city" value="<?php echo $session->ship_to_address_city; ?>">

    <h6>State</h6>
    <input type="text" name="state" value="<?php echo $session->ship_to_address_state; ?>">

    <h6>ZIP</h6>
    <input type="text" name="zip" value="<?php echo $session->ship_to_address_zip; ?>">



    <h6>Country</h6>
    <select name="country_code">
        <?php
        //
        show_completely_presented_country_options();
        ?>
    </select>    



    <br><br>
    <input type="submit" name="set_shipping" value="set shipping"> 
</form>
<br><br><br><br>
<hr>







<?php
// TODO: NOW: Form for shipping options.
?>
<form action="<?php echo LOCAL . '/public/__view/view_transaction/index.php?transaction_content_page=2'; ?>" method="post">
    <?php
// If the shipping address hasn't been set yet,
// disable the button "checkout".
    ?>
    <h4>Shipping Options</h4>
    <select name="shipping_service_charge">
        <?php
        if ($session->get_can_now_checkout()) {
            populate_shipping_options();
        }
        
        ?>
    </select>
    <hr>


    <input type = "submit" name = "checkout" value = "checkout"<?php
    if (!$session->get_can_now_checkout()) {
        echo " disabled";
    }
    ?>>
</form>






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