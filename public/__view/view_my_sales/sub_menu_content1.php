<!--Imports-->
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_invoice.php"); ?>

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
echo "<h3>MySales</h3>";

//
show_sales_history();
?>










<?php
// TODO: DEBUG
echo "<h1 id='for_debug'>FOR DEBUG: </h1>";

?>











<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    main {
        width: 75%;
    }    

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    table.invoice_items_details {
        width: 95%;
        margin-left: 2%;
    }

    table, th, td {
        border: 1px solid black;
    }    

    td {
        padding: 10px;
        vertical-align: middle;

    }    
</style>





<!--Scripts-->
<script src="<?php echo LOCAL . '/public/_scripts/view_my_sales_history_details.js'; ?>"></script>
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / MySales";
</script>

