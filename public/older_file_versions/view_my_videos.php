<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php require_once("../__controller/controller_my_videos.php"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>





<!--sub-menus nav-->
<!--I'm currently adding this for my store page.-->
<a href="#">My Videos</a>
<a href="#">Add Video</a>
</nav>












<!--Meat-->
<?php
// Show the form for adding a new video.
if ($session->is_viewing_own_account()) {
    //
    show_add_new_video_form();
}
?>



<?php
// Display all user's videos.
echo "<h4>MyVideos</h4>";


// 
$completely_presented_user_videos_array = get_completely_presented_user_videos_array();

//
echo "<table>";
//
foreach ($completely_presented_user_videos_array as $completely_presented_user_video) {
    echo $completely_presented_user_video;
}
//
echo "</table>";
?>








<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="../_styles/view_my_videos.css" rel="stylesheet" type="text/css" />
<style>   
    td {
        padding-top: 100px;
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_videos.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MyVideos";
</script>



<script>
// Global variables
    var interval_handle;
    var count = 0;
    var update_interval = 3000;

    window.onload = function () {
        interval_handle = setInterval(start_ad_displayer, update_interval);
    };



    function start_ad_displayer() {

        // For the ad.
        var div_ad = document.getElementsByClassName("ad")[0];

        div_ad.style.backgroundColor = "red";

        div_ad.innerHTML = "<img class='ad' src='<?php echo LOCAL . '/public/_photos/nike_lebron_witness.jpg'; ?>'>";
    }









    function funcer() {
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
                } else {
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





<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
