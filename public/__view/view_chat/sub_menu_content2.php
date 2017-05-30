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
    echo "<div class='section'>";
    show_add_new_video_form();
    echo "</div>";
}
?>



<?php
// Display all user's videos.
echo "<h4 id='my_videos_h4'>MyVideos</h4>";


// 
$completely_presented_user_videos_array = get_completely_presented_user_videos_array();

//
echo "<table id='my_videos_table'>";
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
    
    #my_videos_table td {
        /*padding-top: 100px;*/
    }

    div.timeline_iframe_video_div iframe {
        width: 560px;
        height: 315px;
    }


    .section {
        background-color: rgba(240, 240, 240, 1.0);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);
        

    }

    .form_button {
        /*margin-bottom: 30px;*/
        /*margin-top: 20px;*/
        color: black;
        /*        background-color: rgb(200, 200, 200);*/
        background-color: rgba(255, 157, 45, 0.20);
        box-shadow: 3px 3px 3px rgb(130, 130, 130);
        border: 1px solid;
        font-size: 10px;
        font-weight: 100;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
        margin-right: 5px;        
    }

    .form_button:hover {
        background-color: rgba(255, 157, 45, 0.50);
        cursor: pointer; cursor: hand;
    }

    #add_video_form h6 {
        margin-top: 20px;
        margin-bottom: 10px;
        font-size: 13px;
        font-weight: 100;
    }

    input.form_input {
        width: 300px;
        height: 35px;
        padding: 10px;
        border-radius: 3px;
    }

    textarea.form_input {
        width: 600px;
        height: 180px;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 3px;
    }

    #my_videos_table .timeline_iframe_video_div {
        background-color: rgba(220, 220, 220, 0.30);

        /*padding-bottom: 30px;*/
    }

    .timeline_iframe_video_div h4 {
        color: black;
        font-size: 14px;
        font-weight: 100;
        margin-bottom: 15px;
    }

    #lupetness_a {
        color: black;
        font-size: 12px;
        font-weight: 100;
        display: block;
        margin-top: 15px;
    }

    #lupetness_a:hover {
        color: orange;
    }

    #my_videos_h4 {
        margin-top: 100px;
        margin-left: 30px;
    }


    #my_videos_table td {
        /*margin-bottom: 30px;*/
    }
    
/*    #ad_container {
        visibility: hidden;
    }*/
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
    var update_interval = 50000;

    window.onload = function () {
        setTimeout(start_ad_displayer, 1000);
        setTimeout(start_looping_ad, 1000);
    };

    function start_looping_ad() {
        interval_handle = setInterval(start_ad_displayer, update_interval);
    }



    function xxx() {

        // For the ad.
        var div_ad = document.getElementsByClassName("ad")[0];

        div_ad.style.backgroundColor = "red";


    }









    function start_ad_displayer() {
        //
        var ad_element = document.getElementsByClassName("ad")[0];
//        var ad_element = iframe.getElementById("the_ad");//.innerHTML = xhr.responseText.trim();

        ad_element.style.display = "none";



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

                    ad_element.style.display = "block";

                    ad_element.src = xhr.responseText.trim();


//                    var the_ad = iframe.getElementById('the_ad').mute();
//                    ad_element.mute();
//                    the_ad.mute();


//                    window.alert(xhr.responseText.trim());
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



