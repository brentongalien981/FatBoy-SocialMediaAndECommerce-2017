<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php // require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_my_videos.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>












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













<!--Styles-->
<!--<link href="../_styles/view_my_videos.css" rel="stylesheet" type="text/css" />-->
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
    var update_interval = 1000;

    window.onload = function () {
        interval_handle = setInterval(start_ad_displayer, update_interval);
    };



    function start_ad_displayer() {

        // For the ad.
        var div_ad = document.getElementsByClassName("ad")[0];

        div_ad.style.backgroundColor = "red";

//        div_ad.innerHTML = "<img class='ad' src='<?php // echo LOCAL . '/public/_photos/nike_lebron_witness.jpg'; ?>'>";

        funcer();
    }









    function funcer() {
        //        window.alert("updated");
        //
//        var element_range = document.getElementById("allotment_range_" + ad_id);

        // Also reflect update it to input "allotment_percentage".
//        var element_percentage = document.getElementById("allotment_percentage_" + ad_id);




        // AJAX
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__view/view_my_videos/php_for_ajax_responses/user_hosted_ad_displayer.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    var ad_element = document.getElementsByClassName("ad")[0];//.innerHTML = xhr.responseText.trim();
                    ad_element.src = xhr.responseText.trim();
                    window.alert(xhr.responseText.trim());
                } else {
                    
                }

            }
        }


        //
        var post_key_value_pairs = "currently_viewed_user_id=<?php echo $session->currently_viewed_user_id; ?>";

        //
//        window.alert("VAR post_key_value_pairs: " + post_key_value_pairs);
        xhr.send(post_key_value_pairs);
    }
</script>



