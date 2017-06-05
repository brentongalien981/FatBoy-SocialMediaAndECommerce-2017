<?php
session_start();
?>



<input id="input_user_name" type="hidden" value="<?php
if (isset($_SESSION['user_name'])) {
    echo $_SESSION['user_name'];
}
else {
    echo 'zaza';
}
?>">

<br>
<a href="update.php?user_name=bren">set user_name to bren</a><br>
<a href="update.php?user_name=cj">set user_name to cj</a><br>

<button id="b">set</button>



<script>
    document.getElementById("b").onclick = function() { set_session_user_name_to_zaza(); };
    window.onfocus = function() { set_session_user_name_from_hidden_input(); };
    
    function set_session_user_name_from_hidden_input() {
        var xhr = new XMLHttpRequest();

        var url = "ajax.php";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    console.log("ajax ok");
                }

            }


        }

        //
        var post_key_value_pairs = "set_session_user_name=yes";
        post_key_value_pairs += "&user_name=" + document.getElementById("input_user_name").value;
//        post_key_value_pairs += "&user_name=zaza";

        xhr.send(post_key_value_pairs);
    }
    
    function set_session_user_name_to_zaza() {
        var xhr = new XMLHttpRequest();

        var url = "ajax.php";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    console.log("ajax ok");
                }

            }


        }

        //
        document.getElementById("input_user_name").value = 'zaza'
        
        var post_key_value_pairs = "set_session_user_name=yes";
//        post_key_value_pairs += "&user_name=" + document.getElementById("input_user_name").value;
        post_key_value_pairs += "&user_name=zaza";

        xhr.send(post_key_value_pairs);
    }
    
    
</script>



