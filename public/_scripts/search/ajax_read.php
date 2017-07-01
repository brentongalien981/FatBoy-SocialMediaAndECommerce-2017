<script>
    console.log("****************************");
    console.log("FILE: .../search/ajax_read.php.");



    /*
     * Vars
     */
    var search_result_container_template = document.getElementById("search_result_container_template");



    /*
     * Tasks
     */
    fetch_all_search_suggestions();



    /*
     * Functions
     */
    function show_all_suggestions(json) {

        for (var category in json.suggested_objs_array) {
            console.log("*************************");
            console.log("Inside METHOD: show_all_suggestions()");
            console.log("VAR:category: " + category);



            var num_of_category_suggestions = json.suggested_objs_array[category].length;

            var search_container = null;

            if (num_of_category_suggestions > 0) {
                search_container = search_result_container_template.cloneNode(true);
                search_container.innerHTML = "<h4>Search Results for " + category + "</h4>";
                search_container.innerHTML += "<hr>";
                search_container.style.display = "block";
            }

            var output = "";
            for (var j = 0; j < num_of_category_suggestions; j++) {

                output += "<a class='paged_search_suggestions' href='";

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

            if (search_container != null) {
                search_container.innerHTML += output;
                // Append
                document.getElementById("main_content").appendChild(search_container);
            }

        }
    }

    function fetch_all_search_suggestions() {
        var url = "<?php echo LOCAL . "/public/__controller/search/index.php?fetch_all_search_suggestions=yes"; ?>";

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText.trim();
                // Log before JSON parsing.
                console.log("*** AJAX in METHOD: fetch_all_search_suggestions(). ***");
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
                } else if (json.is_result_ok) {
                    // Else if it's successful..
                    show_all_suggestions(json);
                    console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
                }



                // AJAX JSON log.
                console.log("*** Formatted JSON in METHOD: fetch_all_search_suggestions(). ***");
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


<!--
    <div class="section">
        <h4>Search Results for</h4>
        <hr>
        <p>QUERY:<br></p>
    </div>-->