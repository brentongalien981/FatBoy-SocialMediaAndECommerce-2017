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
//echo "<h3>View my Refunds</h3>";

show_my_refund_items();
?>











<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  

    #left {
        width: 250px;
    }
    #right {
        display: none;
    }
    #middle {
        width: calc(80% + 100px);
        padding-right: 15px;
    }



    #middle_content {
        background-color: rgba(230, 230, 230, 0.8);
        /*padding-bottom: 30px;*/

    }

    #container_my_refund {
        margin: 30px;
        padding: 30px;
        padding-top: 40px;
        border-radius: 5px;
        background-color: rgb(240, 240,240);
    }    
    
    #container_my_refund table {
        width: 90%;
        border-collapse: collapse;
        color: black;
    }
    
        #container_my_refund td {
        border: 1px solid black;
        padding: 10px;
        font-size: 12px;
        font-weight: 100;
    }

    #container_my_refund #td_header {
        background-color: rgb(220, 220, 220);
        font-size: 14px;
        font-weight: 400;
    }

    #container_my_refund table tr:nth-child(even) {
        background-color: rgb(249, 253, 255);

    }

    #container_my_refund table tr:nth-child(odd) {
        background-color: rgb(255, 255, 255);
    } 

    /*    main {
            width: 75%;
        }    
    
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            margin-bottom: 30px;
        }
    
    
        table, th, td {
            border: 1px solid black;
        }    
    
        td {
            padding: 10px;
            vertical-align: middle;
    
        }*/
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "My Refunds";
</script>