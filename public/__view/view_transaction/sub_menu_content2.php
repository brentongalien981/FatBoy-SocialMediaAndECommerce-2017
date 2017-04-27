<?php
// TODO: SECTION: Imports
?>
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/model_address.php");   ?>
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
if (isset($_POST["checkout"]) || isset($session->transaction_shipping_charge)) {
    //
//    $session->can_now_checkout;
    if (isset($_POST['shipping_service_charge'])) {
        $session->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"] = $_POST['shipping_service_charge'];
    }
    else {
        $session->transaction_shipping_charge = $_SESSION["transaction_shipping_charge"];
    }
    
            
    //
    show_shipping_details();

    // 
    show_items();

    //
    show_transaction_charges();



    //
    echo "<form id = 'form' action = 'payment.php' method = 'post'>";
    echo "<input type = 'submit' name = 'pay' value = 'pay'>";
    echo "</form>";
}
?>













<?php
// TODO: SECTION: Styles
?>
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style> 
    table, tr, td {
        margin: 0;
        padding: 0;
    }

    table.cart_items {
        border: 1px solid black;
        border-collapse: collapse;
    }

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
        /*        display: inline;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                background-color: blue;*/
    }

    .shipping_to_details {
        /*        display: inline;
                margin: 0;
                padding: 0;
                width: 30%;
                height: 100%;
                background-color: green;*/
    }
</style>










<?php
// TODO: SECTION: Scripts 
?>
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += "Transaction / Summary";
</script>