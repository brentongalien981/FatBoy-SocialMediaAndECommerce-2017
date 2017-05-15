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
echo "<h3>MyHosted Ads</h3>";

// TODO: REMINDER: Remember to refine the functionality of the allotment range by having a maximum 
// of 100% as a sum of all allotments. You know what this is.. It's like setting attributes for
// MyPlayer on 2K...
show_user_hosted_ads();
?>











<?php
if (isset($_GET["newly_hosted_ad_id"])) {
    // TODO: REMINDER: Highlight the fucking row.
//    die("Highlight the fucking row.");
}
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

    div.ad_sample {
        /*background-color: red;*/
        padding: 20px;
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
    document.getElementById("title").innerHTML += " / MyHosted Ads";
</script>

<script>
    function show_ad_sample_details(ad_id, ad_completely_presented_tr) {
        // Get a reference to the table
        var table_ref = document.getElementById("table_hosted_ads");

        var id_of_selected_tr = "tr_" + ad_id;

        var new_row;

        for (var i = 0; i < document.getElementsByClassName("hosted_ads_trs").length; i++) {
            var current_tr = document.getElementsByClassName("hosted_ads_trs")[i];


            if (current_tr.id == id_of_selected_tr) {
                // Insert a row in the table at row index (i + 2) because the thead row add an index.
                // So in the end, this is almost like table_ref.insertAfter(the selected row).
                new_row = table_ref.insertRow(i + 2);

                //
                new_row.className = "hosted_ads_trs";

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
        new_cell.setAttribute("colspan", "13");


        // Add the item's details table.
        new_cell.innerHTML = ad_completely_presented_tr;



        // Change the text of the button.
        document.getElementById("button_show_ad_" + ad_id).innerHTML = "hide ad";
    }

    function remove_ad_sample_details(id_of_ad_sample_row) {
        // Get a reference to the table
        var table_ref = document.getElementById("table_hosted_ads");


        for (var i = 0; i < document.getElementsByClassName("hosted_ads_trs").length; i++) {
            var current_tr = document.getElementsByClassName("hosted_ads_trs")[i];

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

    function update_allotment_via_percentage(ad_id, old_value) {
//        window.alert("percented");
        //
        var element_percentage = document.getElementById("allotment_percentage_" + ad_id);

        // Also reflect update it to input "allotment_percentage".
        var element_range = document.getElementById("allotment_range_" + ad_id);


        // Don't let the percentage go beyond 0 and 100.
        if (element_percentage.value < 0) {
            // Just set to min.
            element_percentage.value = 0;
        }
        if (element_percentage.value > 100) {
            // Just set to max.
            element_percentage.value = 100;
        }




        // AJAX
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__view/view_my_ads/php_for_ajax_responses/user_hosted_ad_manager.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                // If there's a successful response..
                if (xhr.responseText.trim().length > 0 &&
                    xhr.responseText.trim() != "failed_update_allotment_percentage") {
                
//                    window.alert("success ajax " + xhr.responseText.trim());
                }
                else {
                    // Else it's a failed AJAX request, so just revert to the old value.
                    element_percentage.value = old_value;
                }
                
                // Reflect the value to the range.
                element_range.value = element_percentage.value;
                
            }
        }
       
       
        //
        var post_key_value_pairs = "ad_id=" + ad_id;
        post_key_value_pairs += "&update_allotment_percentage=" + element_percentage.value;

        xhr.send(post_key_value_pairs);       
    }

    function update_allotment_via_range(ad_id, old_value) {
//        window.alert("updated");
        //
        var element_range = document.getElementById("allotment_range_" + ad_id);

        // Also reflect update it to input "allotment_percentage".
        var element_percentage = document.getElementById("allotment_percentage_" + ad_id);


           // AJAX
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__view/view_my_ads/php_for_ajax_responses/user_hosted_ad_manager.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                // If there's a successful response..
                if (xhr.responseText.trim().length > 0 &&
                    xhr.responseText.trim() != "failed_update_allotment_percentage") {
                
//                    window.alert("success ajax " + xhr.responseText.trim());
                }
                else {
                    // Else it's a failed AJAX request, so just revert to the old value.
                    element_range.value = old_value;
                }
                
                // Reflect the value to the range.
                element_percentage.value = element_range.value;
                
            }
        }
       
       
        //
        var post_key_value_pairs = "ad_id=" + ad_id;
        post_key_value_pairs += "&update_allotment_percentage=" + element_range.value;

        xhr.send(post_key_value_pairs);      
    }
</script>