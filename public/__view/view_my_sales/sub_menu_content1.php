<!--Imports-->
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_invoice.php"); ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php
// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
    !$session->is_viewing_own_account()
) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>


<!--Meat-->
<?php
//echo "<h3>MySales</h3>";

//
show_sales_history();
?>










<?php
// TODO: DEBUG
echo "<h1 id='for_debug'>FOR DEBUG: </h1>";
?>


<!--Styles-->
<link href="<?php echo LOCAL . "/public/_styles/view_my_sales/content1.css"; ?>" rel="stylesheet" type="text/css"/>


<!--Scripts-->
<!--<script src="<?php // echo LOCAL . '/public/_scripts/view_my_sales_history_details.js';      ?>"></script>-->
<script>
    function show_details_row(xhr, this_button) {


        // Get a reference to the table
        var table_ref = document.getElementById("sales_history_table");

        var id_of_selected_tr = "tr_" + this_button.id;

        var new_row;

        for (var i = 0; i < document.getElementsByClassName("sales_history_details").length; i++) {
            var current_tr = document.getElementsByClassName("sales_history_details")[i];


            if (current_tr.id == id_of_selected_tr) {
                // Insert a row in the table at row index (i + 2) because the thead row add an index.
                // So in the end, this is almost like table_ref.insertAfter(the selected row).
                new_row = table_ref.insertRow(i + 2);

                //
                new_row.className = "sales_history_details";

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
        var table_ref = document.getElementById("sales_history_table");


        for (var i = 0; i < document.getElementsByClassName("sales_history_details").length; i++) {
            var current_tr = document.getElementsByClassName("sales_history_details")[i];

            if (current_tr.id == row_id) {
//            table_ref.removeChild(table_ref.childNodes[i + 1]);
                table_ref.deleteRow(i + 1);

                break;
            }

        }
    }


    function show_details(this_button) {

        var xhr = new XMLHttpRequest();

        var url = "php_for_ajax_responses/sales_history_details.php?invoice_id=" + this_button.id;
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


    function update_status(the_select_element, old_status_id, selected_status_id, invoice_item_id) {
//        window.alert("puta nanaman invoiceid:" + invoice_id);
        var is_update_sure = window.confirm("Are you sure about the\nstatus update of the item?");


        if (is_update_sure) {
            var xhr = new XMLHttpRequest();

//            var url = "php_for_ajax_responses/invoice_item_status_update.php";
            var url = get_local_url() + "/public/__controller/notifications/NotificationMyShoppingAjaxHandler.php";
            xhr.open('POST', url, true);
            // You need this for POST requests.
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // TODO: REMINDER: Maybe you can refresh the table of invoice items here so
                    // that it will reflect on the status and status date.
                    var response = xhr.responseText.trim();
                    // Log before JSON parsing.
                    console.log("*******************************");
//                    console.log("*** AJAX invoked by class: " + caller_class_name);
//                    console.log("*** CRUD Type: " + crud_type);

                    console.log("*** Log before JSON parsing ***");
                    console.log("response: " + response);


                    //
                    var json = null;

                    try {
                        json = JSON.parse(response);
                    } catch (e) {
                        console.log('ERROR:invalid json');
                        json = null;
                    }


                    // If the response is not successful..
                    if (json === null || !json.is_result_ok) {
                        console.log("RESULT:json.is_result_ok: null/false");
                    } else if (json.is_result_ok) {
                        // Else if it's successful..
                        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                    }

                }
            }


            var post_key_value_pairs = "selected_status_id=" + selected_status_id + "&invoice_item_id=" + invoice_item_id;
            post_key_value_pairs += "&invoice_item_status_update=yes";
//            post_key_value_pairs += "&invoice_id=" + invoice_id;
//            window.alert("DEBUG: VAR post_key_value_pairs = " + post_key_value_pairs);

            xhr.send(post_key_value_pairs);
        } else {
            // Set it back to the previous value.        
            the_select_element.value = old_status_id;
            window.alert("you cancelled");
        }
    }


</script>


<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "FatBoy / MySales";
</script>

