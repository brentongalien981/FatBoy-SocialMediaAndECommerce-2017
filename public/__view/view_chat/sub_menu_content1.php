<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php // require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_chat.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("view_log_in.php");
}
?>












<!--Meat-->
<?php
// Show friends to be clicked to chat with.
echo "<div class='section'>";
show_friends_to_chat_with();
echo "</div>";
?>













<!--Styles-->
<!--<link href="../_styles/view_my_videos.css" rel="stylesheet" type="text/css" />-->
<style>
    a#sub_nav_chat_with {
        color: rgb(194, 255, 119);
        /*color: black;*/
        background-color: rgb(70, 70, 70);
    }

    div.section {
        background-color: rgba(240, 240, 240, 1.0);
        margin: 30px;
        padding: 30px;
        border-radius: 5px;
        box-shadow: 5px 5px 5px rgb(150, 150, 150);


    }

    div.section table {
        font-size: 13px;
        font-weight: 100;
        color: black;
    }

    div.section table,
    div.section table td {
        border: none;
        border-collapse: collapse;
    }

    div.section table td {
        padding: 5px;
        /*padding-left: 5px;*/
        vertical-align: middle;
    }


    .form_button {
        /*text-align: center;*/
        margin: 0;
        /*width: 60px;*/
        /*border: 1px solid rgb(224, 255, 193);*/
        border: none;
        background-color: rgb(224, 255, 193);
        /*color: white;*/
    }  
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_videos.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Chat with / FatBoy";
</script>



<script>
//    window.onload = function () {
//        set_button_chat_with_listener();
//    };
//
//    function set_button_chat_with_listener() {
//        document.getElementById("input_chat_with_friend").onclick = function () {
//            // AJAX
//            var xhr = new XMLHttpRequest();
//
//            var url = "<?php echo LOCAL . '/public/__controller/controller_chat.php'; ?>";
//            xhr.open('POST', url, true);
//            // You need this for AJAX POST requests.
//            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//
//            xhr.onreadystatechange = function () {
//                // If ready..
//                if (xhr.readyState == 4 && xhr.status == 200) {
//
//                    // If there's a successful response..
//                    if (xhr.responseText.trim().length > 0) {
//                        console.log("Method set_button_chat_with_listener() AJAX response: " + xhr.responseText.trim());
//                    }
//                }
//            }
//
//
//            //
//            var chat_with_user_id = document.getElementById("input_chat_with_friend_user_id").value;
//            var post_key_value_pairs = "do_chat=yes&chat_with_user_id=" + chat_with_user_id;
//            xhr.send(post_key_value_pairs);
//        };
//    }
</script>



