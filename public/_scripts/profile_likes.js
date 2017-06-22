// Vars.
var the_add_like_form = document.getElementById("add_like_form");
var add_a_like_button = document.getElementById("add_a_like_button");
var add_the_like_button = document.getElementById("add_the_like_button");
var cancel_add_the_like_button = document.getElementById("cancel_add_the_like_button");






// Event listeners.
if (add_a_like_button != null &&
        add_the_like_button != null &&
        cancel_add_the_like_button != null) {

    add_a_like_button.addEventListener("click", function () {
        show_add_the_like_form();
        hide_add_a_like_button();
        console.log("EVENT: CLICK: by add_a_like_button");
    });

    add_the_like_button.addEventListener("click", function () {
        // AJAX.s
        // Add the like record to db.
        add_the_like();
        console.log("EVENT: CLICK: by add_the_like_button");
    });

    cancel_add_the_like_button.addEventListener("click", function () {
        hide_add_the_like_form();
        show_add_a_like_button();
        console.log("EVENT: CLICK: by cancel_add_the_like_button");
    });
}



// Tasks.
populate_likes_table();







// Functions.
function delete_user_like(like_id) {
    console.log("Inside method delete_user_like().");

    var xhr = new XMLHttpRequest();
    var url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_users_and_likes.php";

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
            console.log("*** AJAX in method delete_user_like(). ***");
            console.log("*** Log before JSON parsing ***");
            console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


            //
            var json = JSON.parse(xhr.responseText.trim());


            if (json.is_result_ok) {
                populate_likes_table();
            }



            // AJAX JSON log.
            console.log("*** Formatted JSON in method delete_user_like(). ***");
            for (var key in json) {
                if (json.hasOwnProperty(key)) {
                    var val = json[key];

                    // Display in the console.
                    console.log(key + " => " + val);

//                    // Display errors in the form.
//                    var error_label = document.getElementById(key);
//                    if (error_label != null) {
//                        error_label.innerHTML = val;
//                    }

                }
            }
        }

    }


    // Create a dynamic hidden csrf_token input.
    var input_csrf_token = get_csrf_input();

    // Dynamically append a hidden csrf input to the form "create_post_form".
    var the_middle_content = document.getElementById("middle_content");
    the_middle_content.appendChild(input_csrf_token);


    //
    var post_key_value_pairs = "delete_user_like=yes";
    post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
    post_key_value_pairs += "&like_id=" + like_id;


    xhr.send(post_key_value_pairs);


    // Right away, remove the hidden csrf input from the form.
    the_middle_content.removeChild(input_csrf_token);
}

function add_the_like() {
    console.log("Inside method add_the_like().");

    var xhr = new XMLHttpRequest();
    var url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_like.php";

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
            console.log("*** AJAX in method add_the_like(). ***");
            console.log("*** Log before JSON parsing ***");
            console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


            //
            var json = JSON.parse(xhr.responseText.trim());


            if (json.is_result_ok) {
                hide_add_the_like_form();
                show_add_a_like_button();
                populate_likes_table();
            }



            // AJAX JSON log.
            console.log("*** Formatted JSON in method add_a_like(). ***");
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
    the_add_like_form.appendChild(input_csrf_token);


    //
    var post_key_value_pairs = "add_the_like=yes";
    post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;
    post_key_value_pairs += "&the_like_value=" + document.getElementById("the_like_input").value;

    xhr.send(post_key_value_pairs);


    // Right away, remove the hidden csrf input from the form.
    the_add_like_form.removeChild(input_csrf_token);
}

function add_event_listeners_to_like_delete_buttons() {
    var like_delete_buttons = document.getElementsByClassName("like_delete_buttons");

    for (var i = 0; i < like_delete_buttons.length; i++) {
        like_delete_buttons[i].addEventListener("click", function () {
            delete_user_like(this.getAttribute("like_id"));
        });
    }
}

function populate_likes_table() {
    console.log("Inside method populate_likes_table().");

    var xhr = new XMLHttpRequest();
    var url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_like.php";

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
            console.log("*** AJAX in method populate_likes_table(). ***");
            console.log("*** Log before JSON parsing ***");
            console.log("xhr.responseText.trim(): " + xhr.responseText.trim());


            //
            var json = JSON.parse(xhr.responseText.trim());
            var like_objects_array = json.like_objects_array
            var num_of_likes = like_objects_array.length;


            if (json.is_result_ok) {
                // Populate the likes_table.
                var likes_table = document.getElementById("like_table");
                // Remove all the previous <tr>s of the table.
                likes_table.innerHTML = "";

                for (var i = 0; i < num_of_likes; i++) {
                    var new_tr = document.createElement("tr");
                    new_tr.innerHTML = "<td><h5>" + like_objects_array[i]['name'] + "</h5></td>";

                    if (json.is_viewing_own_account) {
                        new_tr.innerHTML += "<td><input like_id='" + like_objects_array[i]['id'] + "' type='button' value='delete' class='form_button like_delete_buttons'></td>";
                    }

//                    likes_table.childNodes[0].appendChild(new_tr);
                    likes_table.appendChild(new_tr);
                }

                add_event_listeners_to_like_delete_buttons();
            }



            // AJAX JSON log.
            console.log("*** Formatted JSON in method populate_likes_table(). ***");
            var like_objects_array = json.like_objects_array
            var length = like_objects_array.length;
            for (var i = 0; i < length; i++) {
                // Display in the console.
                console.log("index " + i + ": " + like_objects_array[i]['id'] + " ::: " + like_objects_array[i]['name']);
            }
        }

    }


    // TODO:REMINDER: Delete this chunk later.
//     // Create a dynamic hidden csrf_token input.
//    var input_csrf_token = get_csrf_input();

//    // Dynamically append a hidden csrf input to the form "create_post_form".
//    the_add_address_form.appendChild(input_csrf_token);


    //
    var post_key_value_pairs = "populate_likes=yes";
//    post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;

    xhr.send(post_key_value_pairs);

// TODO:REMINDER: Delete this chunk later.
//    // Right away, remove the hidden csrf input from the form.
//    the_add_address_form.removeChild(input_csrf_token);
}

function hide_add_a_like_button() {
    add_a_like_button.style.display = "none";
}

function show_add_a_like_button() {
    add_a_like_button.style.display = "inline";
}

function show_add_the_like_form() {
    document.getElementById("add_like_form").style.display = "block";
}

function hide_add_the_like_form() {
    document.getElementById("add_like_form").style.display = "none";
}