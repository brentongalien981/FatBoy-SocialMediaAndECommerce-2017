// Vars


// Tasks
show_all_followers();


// Functions
function show_all_followers() {
    console.log("In METHOD: show_all_followers().");

    var url = get_local_url() + "/public/__controller/friends/Followers.php?get_all_followers=yes";


    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            // Log before JSON parsing.
            console.log("*** AJAX in METHOD: show_all_followers(). ***");
            console.log("*** Log before JSON parsing ***");
            console.log("response: " + response);


            //
            var json = null;

            try {
                json = JSON.parse(response);
            } catch (e) {
                console.log('ERROR:invalid json');
                json = null;
            }


            // If the response is not successful..
            console.log("AJAX In METHOD: show_all_followers().");

            if (json == null || !json.is_result_ok) {
                console.log("RESULT:json.is_result_ok: null/false");
            } else if (json.is_result_ok) {
                // Else if it's successful..
                populate_followers(json.followers);


                //
                // add_event_listeners_to_follow_buttons();
                console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
            }


            // AJAX JSON log.
            console.log("*** Formatted JSON in METHOD: show_all_followers(). ***");
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


function populate_followers(followers) {
    //
    var container = document.getElementById("followers_tbody");

    for (var j = 0; j < followers.length; j++) {
        //
        var follower_id = followers[j]["friend_id"];
        var follower_name = followers[j]["user_name"];
        var pic_src = followers[j]["user_pic_src"];
        var tr = document.createElement("tr");

        var content = "";
        content += "<td>";
        content += "<img src='" + get_local_url() + pic_src + "'>";
        content += "</td>";

        content += "<td>";
        content += "<h5>";
        content += follower_name;
        content += "</h5>";

        // TODO:REMINDER: Implement the follow button here too.
        content += "<input";
        content += " id=''";
        content += " type='button'";
        content += " class='form_button'";
        content += " follower_id='" + follower_id + "'";
        content += " follower_name='" + follower_name + "'";
        content += " value='follow'";
        content += ">";
        content += "</td>";


        tr.innerHTML = content;
        //
        container.appendChild(tr);

    }
}
