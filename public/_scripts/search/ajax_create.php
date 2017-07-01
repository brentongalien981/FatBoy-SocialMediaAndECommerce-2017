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
        
        // Redirect.
        window.location.assign("<?php echo LOCAL . "/public/__controller/search/index.php?show_all_search_suggestions=yes"; ?>");
    });




    // Functions.

    function suggestionsToList(json, is_for_page_suggestions = false) {
        // <li><a href="search.php?q=alpha">Alpha</a></li>
        var output = '';

//        var num_of_categories = json.suggested_objs_array.length;

//        for (var i = 0; i < num_of_categories; i++) {
        for (var category in json.suggested_objs_array) {

            var num_of_category_suggestions = json.suggested_objs_array[category].length;
            console.log("DEBUG:num_of_category_suggestions in " + category + ": " + num_of_category_suggestions);

            for (j = 0; j < num_of_category_suggestions; j++) {
                output += "<a href='";

                switch (category) {
                    case "Users_objs_array":
                        output += "<?php echo LOCAL . "/public/__controller/controller_friends.php?view_friend_account=yes"; ?>";
                        output += "<?php echo "&friend_id="; ?>" + json.suggested_objs_array[category][j]["user_id"];
                        output += "<?php echo "&friend_name="; ?>" + json.suggested_objs_array[category][j]["user_name"];
                        output += "'>";
                        output += "USER: " + json.suggested_objs_array[category][j]["user_name"];
                        break;
                    case "MyStoreItems_objs_array":
                        output += "<?php echo LOCAL . "/public/__controller/controller_friends.php?view_friend_account=yes"; ?>";
                        output += "<?php echo "&friend_id="; ?>" + json.suggested_objs_array[category][j]["user_id"];
                        output += "<?php echo "&friend_name="; ?>" + json.suggested_objs_array[category][j]["user_name"];
                        output += "&view_product=yes";
                        output += "<?php echo "&product_id="; ?>" + json.suggested_objs_array[category][j]["id"];
                        output += "'>";
                        output += "PRODUCT: " + json.suggested_objs_array[category][j]["name"];
                        break;
                }

                output += '</a>';
            }
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

        if (search_value.length < 1) {
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

</script>