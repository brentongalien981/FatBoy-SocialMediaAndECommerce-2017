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
    echo "<div id='div_entire_store_cart'>";

    //
    show_store_cart_options_form();

    //
    show_cart_items_form();

    //
    show_set_shipping_button();

    //
    echo "</div>";
} else {
    MyDebugMessenger::add_debug_message("There's no available cart ready to be checked out.");
}
?>










<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_store_cart.css';   ?>" rel="stylesheet" type="text/css" />-->
<style>
    #div_entire_store_cart {
        /*background-color: red;*/
        background-color: rgba(220, 220, 220, 0.3);
        margin: 30px;
        /*margin-top: 0;*/
        padding: 20px;
        border-radius: 5px;
        /*margin-bottom: 60px;*/
        box-shadow: 5px 5px 5px rgba(100, 100, 100, 0.80);
    }

    #div_entire_store_cart form {
        margin-bottom: 40px;
    }

    #div_entire_store_cart h4 {
        display: block;
    }

    #div_entire_store_cart select {
        height: 25px;
    }


    #div_entire_store_cart table {
        /*width: 100%;*/
        border-collapse: collapse;
        /*background-color: pink;*/
        color: black;
        font-size: 13px;
        font-weight: 100;
        /*margin: 30px;*/
        /*margin-right: 30px;*/



    }

    #div_entire_store_cart table,
    #div_entire_store_cart table thead,
    div_entire_store_cart table tr,
    #div_entire_store_cart table td {
        border: 1px solid black;
    }



    #div_entire_store_cart table td {
        padding: 10px;
        vertical-align: middle;
        font-size: 14px;

    }

    #puta {
        /*        background-color: rgba(130, 130, 130, 0.8);*/
        background-color: rgb(255, 188, 81);
        font-size: 15px;
        font-weight: 200;
    }

    #div_entire_store_cart table tr:nth-child(even) {
        background-color: rgba(178, 225, 255, 0.2);
    }

    #div_entire_store_cart table tr:nth-child(odd) {
        background-color: rgba(255, 249, 178, 0.2);
    }
    
        input.quantities {
        width: 50px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }







    /*    th, td {
            padding: 10px;
            vertical-align: middle;

        }

        td input {
            margin-top: -15px;
            padding: 0;
        }*/

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
        document.getElementById("update_cart_items").setAttribute("style", "background-color: rgb(255, 58, 58);");
        document.getElementById("update_cart_items").style.color = "white";
        document.getElementById("update_cart_items").style.border = "1px solid red";
    }
</script>

