var the_parent_post_id;

function createForm(parentPostId) {
    the_parent_post_id = parentPostId;

    // Disable the reply button when the form shows up.
    document.getElementById("replyButton" + parentPostId).setAttribute("disabled", "disabled");
//        document.getElementById("replyButton" + parentPostId).style.backgroundColor = "rgba(100, 100, 100, 0.80)";

    var replyForm = document.createElement("form");
    var replyTextAre = document.createElement("textarea");
    var replyButton = document.createElement("input");
//        var parentPostHiddenInput = document.createElement("input");
//        var cancelButton = document.createElement("button");
    var cancelButton = document.createElement("input");


//        replyForm.setAttribute("action", "timeline_posts_reply.php");
//        replyForm.setAttribute("method", "post");
    replyForm.id = "replyForm" + parentPostId;
    replyForm.setAttribute("class", "replyForm");

//        replyTextAre.setAttribute("name", "reply_text_area");
    replyTextAre.setAttribute("placeholder", "Comment here...");
    replyTextAre.setAttribute("rows", "4");
    replyTextAre.setAttribute("cols", "70");

//        parentPostHiddenInput.setAttribute("type", "hidden");
//        parentPostHiddenInput.setAttribute("name", "parent_post_id");
//        parentPostHiddenInput.setAttribute("value", parentPostId);

    replyButton.setAttribute("type", "button");
//        replyButton.setAttribute("name", "submit");
    replyButton.setAttribute("value", "submit");
//        replyButton.setAttribute("class", "reply_form_buttons");
    replyButton.setAttribute("class", "form_buttons");
    // replyButton.classList.add("reply-post-buttons");

    replyButton.onclick = function () {
        create_reply_post(parentPostId);
    };

    cancelButton.setAttribute("type", "button");
    cancelButton.setAttribute("value", "cancel");
    cancelButton.setAttribute("class", "form_buttons");

    cancelButton.id = "cancelButton";
//        cancelButton.innerHTML = "cancel";
    cancelButton.onclick = function () {
        document.getElementById(parentPostId).removeChild(replyForm);
//            document.getElementById(parentPostId).removeChild(cancelButton);
//            document.getElementById("replyButton" + parentPostId).style.backgroundColor = "rgba(255, 157, 45, 0.20)";

        // // Re-enable the reply button.
        // document.getElementById("replyButton" + parentPostId).removeAttribute("disabled");
    };


    replyForm.appendChild(replyTextAre);
//        replyForm.appendChild(parentPostHiddenInput);
    replyForm.appendChild(document.createElement("br"));
    replyForm.appendChild(replyButton);
//        replyForm.appendChild(document.createElement("br"));
    replyForm.appendChild(cancelButton);

//        document.getElementById(parentPostId).appendChild(replyForm);
    document.getElementById(parentPostId).insertBefore(replyForm, document.getElementById(parentPostId).childNodes[3]);
//    document.getElementById(parentPostId).appendChild(cancelButton);


}

function create_reply_post(parentPostId) {
//        window.alert("the_parent_post_id: " + the_parent_post_id);
    var the_reply_form = document.getElementById("replyForm" + parentPostId);

    // AJAX
    var xhr = new XMLHttpRequest();

    var url = get_local_url() + "/public/__controller/controller_timeline_post_replies.php";
    xhr.open('POST', url, true);
    // You need this for POST requests.
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            if (response.length > 0 && response.substring(0, 1) != "0") {
                console.log("OK post response: " + response);

//                    $completely_presented_reply_post .= "<div id='{$row['id']}' class='replies'>";
                var new_reply_post_div = document.createElement("div");
                new_reply_post_div.className = "replies";
                new_reply_post_div.id = "commentX-TODO";
                new_reply_post_div.innerHTML = response;

                // Append the new reply post before the reply form.
                var post = document.getElementById(parentPostId);
                var len = post.childNodes.length;
                var the_reply_form = post.childNodes[len - 1];
                post.insertBefore(new_reply_post_div, the_reply_form);

                //
                var the_textarea = the_reply_form.childNodes[0];
                the_textarea.value = "";
                // console.log("************************************");
                // console.log(the_reply_form.innerHTML);
                // console.log("************************************");

            } else {
                console.log("BAD post response: " + response);
            }
        }


    }


    // Create a dynamic hidden csrf_token input.
    var input_csrf_token = document.createElement("input");
    input_csrf_token.id = "input_csrf_token";
    input_csrf_token.setAttribute("type", "hidden");
    input_csrf_token.setAttribute("value", get_csrf_token());

    // Dynamically append a hidden csrf input to the form "create_post_form".
    var reference_div = document.getElementById("div_tae");
    reference_div.appendChild(input_csrf_token);


    //
    var post_key_value_pairs = "create_reply_post=yes";

    post_key_value_pairs += "&parent_post_id=" + parentPostId;


    // Get the content of the textarea of the form that popped-up for reply.
//        var the_textarea = document.getElementById(the_parent_post_id).childNodes[4].childNodes[0];
//        var reply_message = the_textarea.value.trim();
    var reply_message = the_reply_form.childNodes[0].value;
    console.log("DEBUG: the_reply_form.id: " + the_reply_form.id);
    console.log("DEBUG: reply_message: " + reply_message);

    post_key_value_pairs += "&reply_message=" + reply_message;
    post_key_value_pairs += "&csrf_token=" + document.getElementById("input_csrf_token").value;


    xhr.send(post_key_value_pairs);


    // Right away, remove the hidden csrf input from the form "create_post_form".
    reference_div.removeChild(input_csrf_token);
}


function create_post() {
    // Check if textarea is empty.
    if (is_textarea_empty(document.getElementById("message_post_textarea"))) {
        return;
    }


    // AJAX
    var xhr = new XMLHttpRequest();

    var url = get_local_url() + "/public/__controller/controller_timeline_posts.php";
    xhr.open('POST', url, true);
    // You need this for POST requests.
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText.trim();
            if (response.length > 0 && response.substring(0, 1) != "0") {
                console.log("OK post response: " + response);
//                    window.alert("puta ko: " + response);

                // Append the new post.
                // This is just a "uniquer/clever" way of appending it..
                // Ok it's not clever, but just "maparaan".
                var new_div_background = document.createElement("div");
                new_div_background.id = "newly_inserted_post";
                new_div_background.setAttribute("class", "post_background");
                new_div_background.innerHTML = response;

                // div_tae is just a hidden div reference for insertion.
                var div_tae = document.getElementById("div_tae");
                var main_content = document.getElementById("main_content");
                main_content.insertBefore(new_div_background, div_tae);






                // Remove div_tae.
                main_content.removeChild(div_tae);

                // Create a new div_tae for the next hidden reference.
                var new_div_tae = document.createElement("div");
                new_div_tae.id = "div_tae";
                main_content.insertBefore(new_div_tae, new_div_background);

                //
                new_div_background.id = "";


                // Clear the textarea.
                document.getElementById("message_post_textarea").value = "";


                //
                var new_post = new_div_background.childNodes[0];
                var new_post_id = new_post.id;
                append_a_comment_form(new_post_id);


                //
                hide_create_post_form();

                // Remove the "post" from post72..
                var item_x_id = new_post_id.substring(4);
                create_rateable_item(item_x_id);


                //
                // are_rateable_item_ids_set = true;
                var post_ids = [item_x_id];
                read_rateable_item_ids(post_ids);


            } else {
                console.log("BAD post response: " + response);
            }

        }
    }

    // Create a dynamic hidden csrf_token input.
    var input_csrf_token = document.createElement("input");
    input_csrf_token.id = "input_csrf_token";
    input_csrf_token.setAttribute("type", "hidden");
    input_csrf_token.setAttribute("value", get_csrf_token());

    // Dynamically append a hidden csrf input to the form "create_post_form".
//        var create_post_form = document.getElementById("create_post_form");
//        create_post_form.appendChild(input_csrf_token);
    var reference_div = document.getElementById("div_tae");
    reference_div.appendChild(input_csrf_token);


    //
    var post_key_value_pairs = "create_post=yes";
    post_key_value_pairs += "&csrf_token=" + input_csrf_token.value;
    post_key_value_pairs += "&message_post=" + document.getElementById("message_post_textarea").value.trim();

    xhr.send(post_key_value_pairs);

    // Right away, remove the hidden csrf input from the form "create_post_form".
//        create_post_form.removeChild(input_csrf_token);
    reference_div.removeChild(input_csrf_token);
}

// I did this function cause with this line
//      input_csrf_token.setAttribute("value", <php echo sessionize_csrf_token(); >);
// for methods create_post() and create_reply_post(),
// PHP runs that line enclosed in php tags twice, making the $_SESSION['csrf_token']
// different. I made this method so it will only run once..
// function get_csrf_token() {
//     return "<?php echo sessionize_csrf_token(); ?>";
// }

function is_textarea_empty(textarea) {
    if (textarea.value.trim() == 0) {
        return true;

    } else {
        return false;
    }
}

window.onload = function () {
    var create_post_button = document.getElementById("create_post_button");
    if (create_post_button != null) {
        create_post_button.onclick = create_post;


    }
};