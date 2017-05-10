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
<!--<link href="<?php // echo LOCAL . '/public/_styles/view_store_cart.css';        ?>" rel="stylesheet" type="text/css" />-->
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
<!--<script src="<?php // echo LOCAL . '/public/_scripts/view_my_shopping_history_details.js';    ?>"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / My Shopping History";


</script>

<script>
    function show_details_row(xhr, this_button) {


        // Get a reference to the table
        var table_ref = document.getElementById("shopping_history_table");

        var id_of_selected_tr = "tr_" + this_button.id;

        var new_row;

        for (var i = 0; i < document.getElementsByClassName("shopping_history_details").length; i++) {
            var current_tr = document.getElementsByClassName("shopping_history_details")[i];



            if (current_tr.id == id_of_selected_tr) {
                // Insert a row in the table at row index (i + 2) because the thead row add an index.
                // So in the end, this is almost like table_ref.insertAfter(the selected row).
                new_row = table_ref.insertRow(i + 2);

                //
                new_row.className = "shopping_history_details";

                //
                new_row.id = "tr_details_" + this_button.id;

                break;
            }
        }


        // Insert a cell in the row at index 0
        var new_cell = new_row.insertCell(0);
        new_cell.setAttribute("colspan", "5");


        // Add the item's details table.
        new_cell.innerHTML = xhr.responseText;


        // Change the text of the button.
        this_button.innerHTML = "hide";
    }

    function remove_details_row(row_id) {
        // Get a reference to the table
        var table_ref = document.getElementById("shopping_history_table");


        for (var i = 0; i < document.getElementsByClassName("shopping_history_details").length; i++) {
            var current_tr = document.getElementsByClassName("shopping_history_details")[i];

            if (current_tr.id == row_id) {
//            table_ref.removeChild(table_ref.childNodes[i + 1]);
                table_ref.deleteRow(i + 1);

                break;
            }

        }
    }

//function do_refund(invoice_item_id) {
//    window.alert("Method do_refund() called.\n");
//}

    function show_details(this_button) {

        var xhr = new XMLHttpRequest();

//    var url = "http://localhost/myPersonalProjects/FatBoy/public/__view/view_transaction/php_for_ajax_responses/shopping_history_details.php";
        var url = "php_for_ajax_responses/shopping_history_details.php?invoice_id=" + this_button.id;
        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            console.log('readyState: ' + xhr.readyState);
            if (xhr.readyState == 2) {
//            target.innerHTML = 'Loading...';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (this_button.innerHTML == "show") {
                    show_details_row(xhr, this_button);
                }
                // Else, means the button text is "hide".
                else {
                    var row_id = "tr_details_" + this_button.id;
                    remove_details_row(row_id);

                    this_button.innerHTML = "show";
                }
            }
        }
        xhr.send();
    }




//    function do_refund(invoice_item_id) {
//        var is_refund_sure = confirm("Are you sure about this refund?");
//        
//
//        if (is_refund_sure) {
//            var xhr = new XMLHttpRequest();
//            
//            var url = "<?php echo LOCAL; ?>";
//
//            url += "/public/__controller/controller_invoice.php";
//            xhr.open('POST', url, true);
//            // You need this for POST requests.
//            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//            
//            
////            xhr.onreadystatechange = function () {
////                console.log('readyState: ' + xhr.readyState);
////                if (xhr.readyState == 2) {
////                }
////                if (xhr.readyState == 4 && xhr.status == 200) {
////                    window.alert("putang ina nanaman palagi" + xhr.responseText.trim());
////                }
////            }            
//
//            var post_key_value_pairs = "invoice_item_id=" + invoice_item_id;
////            window.alert("DEBUG: VAR post_key_value_pairs = " + post_key_value_pairs);
////            window.alert("VAR url" + url);
//            xhr.send(post_key_value_pairs);
//           
//        } 
//    }
</script>









<?php
// TODO: SECTION: This section is coming from the page "Notifications" where
// the user clicked the view link.
if (!isset($_GET["shopping_history_item_status_update"])) {
    return;
}
?>


<?php
// TODO: SECTION: Script for color highlighting the invoice row that the notification points to.
?>
<script>
    window.alert("an update! Plus the invoice id: <?php echo $_GET['invoice_item_id']; ?>");

    // Highlight the row with the invoice id.
    document.getElementById("tr_<?php echo $_GET['invoice_id']; ?>").style.backgroundColor = "rgba(145, 239, 45, 0.50)";



    // TODO: REMINDER: Also, don't forget to highlight the actual invoice item that has been updated.
    // Highlight the row with the invoice item id.
//        document.getElementById("invoice_item_id_tr_<?php // echo $_GET['invoice_item_id'];     ?>").style.backgroundColor = "#e8a0b8";

</script>


