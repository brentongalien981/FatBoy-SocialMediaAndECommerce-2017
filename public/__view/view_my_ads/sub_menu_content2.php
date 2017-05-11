<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_ad.php"); ?>

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
echo "<h3>Ad Market</h3>";

// Show produced and active ads.
show_produced_ads();
?>











<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>  
    form {
        margin-top: auto;
        margin-bottom: auto;
        /*padding: 0;*/
        vertical-align: middle;
    }

    form h6 {
        margin-bottom: 0px;
        font-weight: 200;
    }

    iframe {
        width: 640px;
        height: 400px;
    }

    img {
        width: 640px;
        height: 480px;        
    }

    main {
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

    }       
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += "FatBoy / Ad Market";
</script>

<script>
    function show_ad_sample_details(ad_id, ad_completely_presented_tr) {
        // Get a reference to the table
        var table_ref = document.getElementById("table_ad_market");

        var id_of_selected_tr = "tr_" + ad_id;

        var new_row;

        for (var i = 0; i < document.getElementsByClassName("ad_market_trs").length; i++) {
            var current_tr = document.getElementsByClassName("ad_market_trs")[i];


            if (current_tr.id == id_of_selected_tr) {
                // Insert a row in the table at row index (i + 2) because the thead row add an index.
                // So in the end, this is almost like table_ref.insertAfter(the selected row).
                new_row = table_ref.insertRow(i + 2);

                //
                new_row.className = "ad_market_trs";

                //
                new_row.id = "tr_ad_sample_" + ad_id;


                // Now that the new row is ready to be displayed,
                // exit the loop and populate it with the "ad_completely_presented_tr".
                break;
            }
        }


        // This is after the break.
        // Insert a cell in the row at index 0
        var new_cell = new_row.insertCell(0);
        new_cell.setAttribute("colspan", "10");


        // Add the item's details table.
        new_cell.innerHTML = ad_completely_presented_tr;



        // Change the text of the button.
        document.getElementById("button_show_ad_" + ad_id).innerHTML = "hide ad";
    }
    
    function remove_ad_sample_details(id_of_ad_sample_row) {
        // Get a reference to the table
        var table_ref = document.getElementById("table_ad_market");


        for (var i = 0; i < document.getElementsByClassName("ad_market_trs").length; i++) {
            var current_tr = document.getElementsByClassName("ad_market_trs")[i];

            if (current_tr.id == id_of_ad_sample_row) {
                table_ref.deleteRow(i + 1);

                break;
            }

        }        
    }

    function show_ad_sample(ad_id) {
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__view/view_my_ads/php_for_ajax_responses/ad_sample_presenter.php'; ?>";
        url += "?ad_id=" + ad_id;
        xhr.open('GET', url, true);

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {
//                window.alert("AJAX is ok " + xhr.responseText.trim());
                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    // Get the button element that's been clicked..
                    var the_button = document.getElementById("button_show_ad_" + ad_id);

                    if (the_button.innerHTML == "view ad") {
                        show_ad_sample_details(ad_id, xhr.responseText.trim());
                    }
                    // Else, means the button text is "hide ad".
                    else {
                        var id_of_ad_sample_row = "tr_ad_sample_" + ad_id;
                        remove_ad_sample_details(id_of_ad_sample_row);

                        
                        // Set the button's text back to default.
                        the_button.innerHTML = "view ad";
                    }
                }
            }
        }
        xhr.send();
    }
</script>