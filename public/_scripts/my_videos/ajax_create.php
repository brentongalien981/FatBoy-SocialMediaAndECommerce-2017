<script>
    // Vars.
    var create_video_button = document.getElementById("create_video_button");






    // Event listeners.
    create_video_button.addEventListener("click", function () {
        create_video();
        console.log("EVENT:CLICK: by BUTTON:create_video_button.");
    });





    // Functions.
    function create_video() {
        console.log("Inside method create_video().");

        var xhr = new XMLHttpRequest();
        var url = document.getElementById("add_video_form").getAttribute("action");

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If there's a successful response..
            if (xhr.readyState == 4 &&
                    xhr.status == 200 &&
                    xhr.responseText.trim().length > 0)
            {

                // Log before JSON parsing.
                console.log("*** AJAX in method create_video(). ***");
                console.log("*** Log before JSON parsing ***");
                console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


                //
                var json = JSON.parse(xhr.responseText.trim());


                if (json.is_result_ok) {
                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
//                hide_add_the_like_form();
//                show_add_a_like_button();
//                populate_likes_table();
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in method create_video(). ***");
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        var val = json[key];

                        // Display in the console.
                        console.log(key + " => " + val);

                    // Display errors in the form.
                    var error_label = document.getElementById(key);
                    if (error_label != null) {
                        error_label.innerHTML = val;
                    }

                    }
                }
            }

        }


        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "create_video=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&title=" + document.getElementById("video_title").value;
        post_key_value_pairs += "&embed_code=" + document.getElementById("embed_code").value;

        xhr.send(post_key_value_pairs);


        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);
    }
        </script