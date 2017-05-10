<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>

<!--File session.php is already included in header.php.-->
<?php require_once("../_layouts/header.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__controller/controller_like.php"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>











<!--sub-menus nav-->
<!--I'm currently adding this for my store page.-->
<a>sub-menu1</a>
<a>sub-menu2</a>
</nav>






<!--Main content.-->
<?php
echo "EXPER FOR NOTIFICATION";
echo "<button id='stopButton'>stop notifier</button>";
?>

<br>
<input id="notification_name" type="text">
<button id="notify_button">notify</button>
<br><br><br>
<div id="the_div">

</div>


<?php
for ($i = 0; $i < 200; $i++) {
    echo "<div id='{$i}' class='sections'>";
    echo $i;
    echo "</div>";
}
?>












<!--Debug/Log-->
<?php
// TODO: LOG
MyDebugMessenger::show_debug_message();
MyDebugMessenger::clear_debug_message();
?>







<!--Styles-->
<link href="../_styles/view_profile.css" rel="stylesheet" type="text/css" />
<style>
    div.sections {
        width: 80%;
        height: 100px;
        margin: 10px;
        background-color: yellow;
    } 
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_profile.js"></script>-->
<script>
// Global variables
    var intervalHandle;
    var count = 0;

    window.onload = function () {
        intervalHandle = setInterval(startNotifier, 3000);

        document.getElementById("stopButton").onclick = function () {
            clearInterval(intervalHandle);
            window.alert("intervalHandle cleared.");
        };

        document.getElementById("notify_button").onclick = notify;
    };

    function notify() {
        var xhr = new XMLHttpRequest();

        var url = "example_notifier.php";
        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

//        xhr.onreadystatechange = function () {
//            console.log('readyState: ' + xhr.readyState);
//            if (xhr.readyState == 2) {
////            target.innerHTML = 'Loading...';
//            }
//            if (xhr.readyState == 4 && xhr.status == 200) {
//                document.getElementById("the_div").innerHTML = xhr.responseText + count;
//                ++count;
//            }
//        }

        var notification_name = document.getElementById("notification_name").value;

        var post_key_value_pairs = "notification_name=" + notification_name;
        xhr.send(post_key_value_pairs);
    }

    function startNotifier() {
        var xhr = new XMLHttpRequest();

        var url = "example_notifier.php";
        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            console.log('readyState: ' + xhr.readyState);
            if (xhr.readyState == 2) {
//            target.innerHTML = 'Loading...';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {

                if (xhr.responseText.trim().length == 0) {
                    return;

                }

                document.getElementById("the_div").innerHTML = xhr.responseText;

                var links_arr = document.getElementsByClassName("notification_links");

                for (var i = 0; i < links_arr.length; i++) {
                    links_arr[i].onclick = function () {
                        window.alert("clicked");
//            
//            document.getElementById("3").style.background = "red";
                    };
                }





            }
        }

        var post_key_value_pairs = "key1=value1&fetch_notification_record=yes";
        xhr.send(post_key_value_pairs);
    }
</script>







<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
