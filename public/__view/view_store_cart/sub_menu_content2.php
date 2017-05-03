<?php require_once(PUBLIC_PATH . "/__controller/controller_invoice.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<?php
// TODO: SECTION: Functions.
?>










<!--Meat-->
<?php
// TODO: SECTION: Meat.
echo "<h3>My Shopping History</h3>";


// 
show_shopping_history();
?>












<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_store_cart.css';    ?>" rel="stylesheet" type="text/css" />-->
<style>  
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    
    table.invoice_items_details {
        width: 95%;
        margin-left: 3%;
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
<script src="<?php echo LOCAL . '/public/_scripts/view_my_shopping_history_details.js';   ?>"></script>
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / My Shopping History";


</script>


