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

        var url = "<?php echo LOCAL . '/public/__view/my_videos/php_for_ajax_responses/user_hosted_ad_displayer.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                console.log("*** FILE:ad_displayer.php AJAX ***");
                console.log("responseText: " + xhr.responseText.trim());

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