<?php require_once(PUBLIC_PATH . "/__controller/controller_store_cart.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<!--Meat-->
<?php
// Display an initial store cart if there's an available incomplete cart ready to be checked out.
// But check if there's one available.
if (isset($session->cart_id)) {
    //
    MyDebugMessenger::add_debug_message("You are now viewing your cart.");

    //
    show_store_cart_options_form();

    //
    show_cart_items_form();

    //
    show_set_shipping_button();
} 
else {
    MyDebugMessenger::add_debug_message("There's no available cart ready to be checked out.");
}
?>










<!--Styles-->
<link href="<?php echo LOCAL . '/public/_styles/view_store_cart.css'; ?>" rel="stylesheet" type="text/css" />
<style>  
    th, td {
        padding: 10px;
        vertical-align: middle;

    }

    td input {
        margin-top: -15px;
        padding: 0;
    }

    #form_continue_to_shipping {
        text-align: right;
        /*background-color: red;*/
        /*text-align: right*/
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_store_cart.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MyCart";


    function update_quantity_of_items() {
        var default_action_url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_store_cart.php";
        var length = document.getElementsByClassName("quantities").length;
        var quantitiesForGetUrl = "?";



        for (var i = 0; i < length; i++) {
            quantitiesForGetUrl = quantitiesForGetUrl +
                    document.getElementsByClassName("quantities")[i].id +
                    //                    i +
                    "=" +
                    document.getElementsByClassName("quantities")[i].value +
                    "&";

        }


        var form = document.getElementById("form");
        
        
        // Enable the update button.
        document.getElementById("update_cart_items").disabled = false;
        

//    var defaultUrl = "my_cart.php";

        var updatedUrl = default_action_url + quantitiesForGetUrl;

        form.setAttribute("action", updatedUrl);
        //window.alert("updatedUrl: " + updatedUrl);

        // Change the color of the button to red
        // to notify the buyer that she needs to update the page.
        document.getElementById("update_cart_items").setAttribute("style", "background-color: yellowgreen;");

    }
</script>

