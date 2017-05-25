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
// Show produced and active ads.
show_produced_ads();
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
        padding-bottom: 30px;

    }

    #container_table_ad_market {
        margin: 30px;
        padding: 30px;
        padding-top: 40px;
        border-radius: 5px;
        background-color: beige;
    }

    #table_ad_market {
        /*width: 100%;*/
        border-collapse: collapse;
        /*background-color: pink;*/
        color: black;
        font-size: 13px;
        font-weight: 100;
        /*margin: 30px;*/
        /*margin-right: 30px;*/



    }

    #table_ad_market,
    #table_ad_market thead,
    table_ad_market tr,
    #table_ad_market td {
        border: 1px solid black;
    }


    #table_ad_market tr td {
        /*        font-size: 10px;
                font-weight: 100;*/
    }

    td.header_cells {
        background-color: rgba(130, 130, 130, 0.8);
        font-size: 14px;
        font-weight: 200;
    }


    #table_ad_market td {
        padding: 10px;
        vertical-align: middle;

    }

    #table_ad_market tr:nth-child(even) {
        background-color: rgba(178, 225, 255, 0.2);
    }

    #table_ad_market tr:nth-child(odd) {
        background-color: rgba(255, 249, 178, 0.2);
    }

    .form_button {
        margin: 0;
        margin-left: 5px;
        margin-right: 5px;
        padding: 2px;
        padding-left: 4px;
        padding-right: 4px;
    }








/*    div.ad_sample:parent {
        width: inherit;
        background-color: violet;
    }*/

    div.ad_sample {

        /*background-color: red;*/
        margin-left: 30px;
        padding: 20px;
    }

    div.ad_sample h3,
    div.ad_sample p {
        margin-top: 20px;
        margin-bottom: 20px;
        width: 640px;
    }

    #ad_sample_container {
        width: 640px;
        height: 400px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 5px;
        background-color: rgba(50, 50, 50, 0.6);
    }


    iframe.ad_iframe {
        margin-left: auto;
        margin-right: auto;
        width: 640px;
        height: 400px;
    }

    /*
        img {
            width: 640px;
            height: 480px;
        }*/


</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Ad Market / FatBoy";
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