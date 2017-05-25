<?php
// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_address.php");      ?>
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
// TODO: NOW: Show shipping summary.
//if (isset($_POST["checkout"]) || isset($session->transaction_shipping_charge)) {
if (isset($_POST["checkout"])) {

////    $session->can_now_checkout;
//    if (isset($_POST['shipping_service_charge'])) {
//        $session->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"] = $_POST['shipping_service_charge'];
//    }
//    else {
//        $session->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"];
//    }
    //
    show_shipping_details();

    // 
    show_items();

    //
    show_transaction_charges();



    // TODO: SECTION: Form for paying through PayPal.
    echo "<form id = 'form_pay' action = '" . LOCAL . "/public/__controller/controller_payment.php' method = 'post'>";
    echo "<input type = 'submit' name = 'pay' class='form_button' value = 'pay'>";
    echo "</form>";
}
?>













<?php
// TODO: SECTION: Styles
?>
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style> 
    /*#form_pay*/
    #shipping_details,
    #div_cart_items,
    #div_transaction_charges {
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

    #shipping_details table,
    #div_cart_items table {
        margin-top: 20px;
        color: black;
    }

    #shipping_details table h4,
    #div_transaction_charges h4 {
        font-size: 15px;
        font-weight: 300px;
        margin-bottom: 10px;
    }

    #shipping_details table h5 {
        font-size: 13px;
        font-weight: 100px;
        margin-bottom: 5px;
    }

    #shipping_details table td {
        padding-right: 150px;
    }


    #div_cart_items table.cart_items,
    #div_cart_items td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    #div_cart_items td {
        padding: 10px;
    }

    #div_cart_items #header_tds {
        /*        background-color: rgba(130, 130, 130, 0.8);*/
        background-color: rgb(255, 188, 81);
        font-size: 15px;
        font-weight: 200;
    }

    #div_cart_items table tr:nth-child(even) {
        background-color: rgba(178, 225, 255, 0.2);
    }

    #div_cart_items table tr:nth-child(odd) {
        background-color: rgba(255, 249, 178, 0.2);
    }        



    #div_transaction_charges h6 {
        font-size: 11px;
        font-weight: 100px;
        margin-bottom: 8px;
    }

    #div_transaction_charges hr {
        /*border: 1px solid gray;*/
        background-color: gray;
        /*color: red;*/
        height: 1px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    #div_transaction_charges h4 {
        margin-bottom: 20px;
    }
    /*    
    
        table.cart_items td {
            border: 1px solid black;
            padding: 10px;
        }
    
        table.shipping_details {
    
            width: 70%;
        }
    
        tr {
            width: 100%;
        }
    
        table.shipping_details td {
            width: 50%;
        }
    
        .shipping_from_details {
                    display: inline;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                    height: 100%;
                    background-color: blue;
        }
    
        .shipping_to_details {
                    display: inline;
                    margin: 0;
                    padding: 0;
                    width: 30%;
                    height: 100%;
                    background-color: green;
        }*/
</style>










<?php
// TODO: SECTION: Scripts 
?>
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Transaction Summary / FatBoy";
</script>