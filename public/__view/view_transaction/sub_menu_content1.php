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
    <input type="text" class="form_text_input" name="street1" value="<?php echo $session->ship_to_address_street1; ?>">

    <h6>Street2</h6>
    <input type="text" name="street2" class="form_text_input" value="<?php echo $session->ship_to_address_street2; ?>">

    <h6>City</h6>
    <input type="text" name="city" class="form_text_input" value="<?php echo $session->ship_to_address_city; ?>">

    <h6>State</h6>
    <input type="text" name="state" class="form_text_input" value="<?php echo $session->ship_to_address_state; ?>">

    <h6>ZIP</h6>
    <input type="text" name="zip" class="form_text_input" value="<?php echo $session->ship_to_address_zip; ?>">



    <h6>Country</h6>
    <select name="country_code">
        <?php
        //
        show_completely_presented_country_options();
        ?>
    </select>    



    <br><br>
    <input type="submit" class="form_button" name="set_shipping" value="set shipping"> 
</form>







<?php
// TODO: NOW: Form for shipping options.
?>
<form id="form_shipping_options" action="<?php echo LOCAL . '/public/__view/view_transaction/index.php?transaction_content_page=2'; ?>" method="post">
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


    <input type = "submit" name = "checkout" class="form_button" value = "checkout"<?php
        if (!$session->get_can_now_checkout()) {
            echo " disabled";
        }
        ?>>
</form>






<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    /*    table {
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
        }*/

    #form_shipping,
    #form_shipping_options {
        /*background-color: red;*/
        background-color: rgba(220, 220, 220, 0.3);
        /*background-color: pink;*/
        color: black;
        margin: 30px;
        /*margin-top: 0;*/
        padding: 20px;
        border-radius: 5px;
        /*margin-bottom: 60px;*/
        box-shadow: 5px 5px 5px rgba(100, 100, 100, 0.80);
    }
    
    #form_shipping_options {
        margin-top: 50px;
    }

    #form_shipping h4,
    #form_shipping_options h4 {
        display: block;
        margin-bottom: 30px;
        font-size: 15px;
        font-weight: 300;
    }



    #form_shipping h6,
    #form_shipping_options h6 {
        margin-top: 15px;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 100;
    } 
    
/*    #form_shipping input,
    #form_shipping_options input {
                height: 25px;
        border-radius: 3px;
        padding-left: 5px;
        padding-right: 5px;
    }*/

    #form_shipping select,
    #form_shipping_options select {
        height: 25px;
    }
    
    .form_text_input {
        width: 200px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Shipping Info / FatBoy";
</script>