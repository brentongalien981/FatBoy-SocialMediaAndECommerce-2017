<script>
    // Vars.
    var search_button = document.getElementById("search_button");
    var search_input = document.getElementById("search_input");
    var search_suggestions = document.getElementById("search_suggestions");



    console.log("****************************");
    console.log("FILE: .../search/ajax_create.php.");



    // Event listeners.
    // use "input" (every key), not "change" (must lose focus)
    search_input.addEventListener("input", function () {
        console.log("EVENT:INPUT by search_input");
        getSuggestions();
    });

    search_button.addEventListener("click", function () {
        console.log("EVENT:CLICK by search_button");
    });




    // Functions.

    function suggestionsToList(json) {
        // <li><a href="search.php?q=alpha">Alpha</a></li>
        var output = '';

        for (i = 0; i < json.num_of_suggestions; i++) {
            output += '<li>';
            output += "<a href='#'>";
            output += "TAE SEARCH result.";
            output += '</a>';
            output += '</li>';
        }

        return output;
    }

    function showSuggestions(json) {
        var li_list = suggestionsToList(json);
        search_suggestions.innerHTML = li_list;
//        suggestions.style.display = 'block';
    }

    function getSuggestions() {
        var search_value = search_input.value;

        if (search_value.length < 2) {
            search_suggestions.style.display = 'none';
            return;
        }

        var url = "<?php echo LOCAL . "/public/__controller/search/index.php?search=yes&search_value="; ?>";
        url += search_value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText.trim();
                                    // Log before JSON parsing.
                    console.log("*** AJAX in METHOD: getSuggestions(). ***");
                    console.log("*** Log before JSON parsing ***");
                    console.log("result: " + result);
                
                

                                    //
                    var json = null;

                    try
                    {
                        json = JSON.parse(result);
                    } catch (e)
                    {
                        console.log('ERROR:invalid json');
                        json = null;
                    }
                    
                
                    // If the response is not successful..
                    if (json == null || !json.is_result_ok) {
                        console.log("RESULT:json.is_result_ok: null/false");
                        search_suggestions.style.display = "none";
                    } else if (json.is_result_ok) {
                        // Else if it's successful..
                        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                        search_suggestions.style.display = "block";
                        showSuggestions(json);
                    }             
                    
                    
                    
                    // AJAX JSON log.
                    console.log("*** Formatted JSON in METHOD: getSuggestions(). ***");
                    for (var key in json) {
                        if (json.hasOwnProperty(key)) {
                            var val = json[key];

                            // Display in the console.
                            console.log(key + " => " + val);

//                            // Display errors in the form.
//                            var error_label = document.getElementById(key);
//                            if (error_label != null) {
//                                error_label.innerHTML = val;
//                            }
                        }
                    }                    
                
                
                
                
            }
        };
        xhr.send();
    }

    function create_video() {
        console.log("Inside METHOD: create_video().");

        var xhr = new XMLHttpRequest();
        var url = "<?php echo LOCAL . "/public/__controller/my_videos/index.php"; ?>";

        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        //
        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.readyState == 4 &&
                        xhr.status == 200 &&
                        xhr.responseText.trim().length > 0)
                {

                    // Log before JSON parsing.
                    console.log("*** AJAX in METHOD: create_video(). ***");
                    console.log("*** Log before JSON parsing ***");
                    console.log("responseText: " + xhr.responseText.trim());


                    //
                    var json = null;

                    try
                    {
                        json = JSON.parse(xhr.responseText.trim());
                    } catch (e)
                    {
                        console.log('ERROR:invalid json');
                        json = null;
                    }


                    // If the response is not successful..
                    if (json == null || !json.is_result_ok) {
                        console.log("RESULT:json.is_result_ok: null/false");
                    } else if (json.is_result_ok) {
                        // Else if it's successful..
                        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                    }


                    // AJAX JSON log.
                    console.log("*** Formatted JSON in METHOD: create_video(). ***");
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
        }



        xhr.send(get_post_key_value_pairs_for_create());
    }

    function get_post_key_value_pairs_for_create() {
        console.log("Inside METHOD: get_post_key_value_pairs_for_create().");
        // Create a dynamic hidden csrf_token input.
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);


        //
        var post_key_value_pairs = "create_video=yes";
        post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
        post_key_value_pairs += "&title=" + document.getElementById("video_title").value;
        post_key_value_pairs += "&embed_code=" + document.getElementById("embed_code").value;


        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);


        return post_key_value_pairs;
    }
</script>