// Vars


// Tasks
show_all_muses();


// Functions
function show_all_muses() {
    console.log("In METHOD: show_all_muses().");

    var url = get_local_url() + "/public/__controller/friends/Muses.php?get_all_muses=yes";


    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            // Log before JSON parsing.
            console.log("*** AJAX in METHOD: show_all_muses(). ***");
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
            console.log("AJAX In METHOD: show_all_muses().");

            if (json == null || !json.is_result_ok) {
                console.log("RESULT:json.is_result_ok: null/false");
            } else if (json.is_result_ok) {
                // Else if it's successful..
                populate_muses(json.muses);


                //
                // add_event_listeners_to_follow_buttons();
                console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
            }


            // AJAX JSON log.
            console.log("*** Formatted JSON in METHOD: show_all_muses(). ***");
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


function populate_muses(muses) {
    //
    var container = document.getElementById("muses_tbody");

    for (var j = 0; j < muses.length; j++) {
        //
        var muse_id = muses[j]["user_id"];
        var muse_name = muses[j]["user_name"];
        var pic_src = muses[j]["user_pic_src"];
        var tr = document.createElement("tr");

        var content = "";
        content += "<td>";
        content += "<img src='" + get_local_url() + pic_src + "'>";
        content += "</td>";

        content += "<td>";
        content += "<h5>";
        content += muse_name;
        content += "</h5>";

        // TODO:REMINDER: Implement the unfollow button here too.
        content += "<input";
        content += " id=''";
        content += " type='button'";
        content += " class='form_button'";
        content += " muse_id='" + muse_id + "'";
        content += " muse_name='" + muse_name + "'";
        content += " value='unfollow'";
        content += ">";
        content += "</td>";


        tr.innerHTML = content;
        //
        container.appendChild(tr);

    }
}
