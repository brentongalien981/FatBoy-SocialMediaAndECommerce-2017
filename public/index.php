<?php // require_once("../private/includes/initializations.php");                         ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");                         ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");                         ?>
<?php require_once("_layouts/header.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<main id="middle_content">

    <!--    Sub-menus
        <nav id="sub_menus_nav">
            I'm currently adding this for my store page.
            <a id="tae" href="#">Sub-menu1</a>
            <a href="#">Sub-menu2</a>
        </nav>-->












    <?php
    if ($session->is_logged_in()) {
        echo "<div id='create_post_form'>";
        echo "<textarea id='message_post_textarea' rows='6' cols='100' placeholder='What u be thinking...'></textarea><br>";

        echo "<input id='create_post_button' type='button' class='form_buttons' value='Yow!'>";
        echo "</div>";


        // This is just a refernce node for appending new post element...

        echo "<div id='div_tae'>";
        echo "</div>";
    }
    ?>







    <!--Meat-->
    <?php
// TODO: Show timeline notifications.
// TODO: A lot yet to be done. Timeline post form, timeline notification, etc.



    if ($session->is_logged_in()) {
//
//        echo "<h3>Timeline";
//        echo " {$session->currently_viewed_user_name}";
//        echo "</h3><br>";
        // This file takes care of the query for getting all the timeline posts.
        require_once("__controller/controller_timeline_posts.php");

        //
        $completely_presented_timeline_notifications_array = get_completely_presented_timeline_notifications_array($session->currently_viewed_user_id);

        // Display the timeline posts of the current user being viewed.
        foreach ($completely_presented_timeline_notifications_array as $post) {
            echo $post;
        }


        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("So far so good.");
    }


////
//if (isset($_GET["is_viewing_actual_user_again"])) {
//    $session->reset_currently_viewed_user();
//
//    redirect_to(LOCAL . "/public/index.php");
//}
    ?>






    <?php
// TODO: LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>
</main>

















<!--Styles-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/header.css';                       ?>" rel="stylesheet" type="text/css">-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/index.css';                       ?>" rel="stylesheet" type="text/css">-->
<style>


    textarea {
        border-radius: 4px;
    }

    .message_post {
        /*background-color: rgba(153, 255, 153, 0.1);*/
        background-color: rgba(220, 220, 220, 0.95);
        box-shadow: 5px 5px 5px rgb(130, 130, 130);
        /*margin: 20px;*/
        /*margin-bottom: 30px;*/
        /*background-color: pink;*/
        margin-left: 20px;
        margin-right: 20px;
        /*width: 100%;*/
        /*padding: 10px;*/
        border-radius: 5px;
        padding-left: 20px;
        /*padding-top: 20px;*/
        padding-bottom: 30px;
    }

    .message_post h4 {
        margin: 0;
        padding: 0;
        padding-top: 20px;
        font-size: 17px;
        font-weight: 300;
    }

    .message_post h5 {
        margin: 0;
        padding: 0;
        font-size: 11px;
        font-weight: 100;
        font-style: italic;
    }


    .message_post p {
        font-size: 14px;
        font-weight: 100;
        margin-top: 20px;

    }

    .timeline_post_p {
        margin-bottom: 50px;
    }



    .message_post h4,
    .message_post h5,
    .message_post p,
    .link_reply {
        /*margin-left: 20px;*/
    }

    button.link_reply {
        margin-left: 20px;
    }


    /*    .link_reply {
            color: black;
            background-color: rgb(200, 200, 200);
            font-size: 70%;
            font-weight: 100;
            padding: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 3px;
        }

        .link_reply a {
            color: black;
            background-color: pink;
            padding: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 3px;
        }*/

    .replyForm {
        margin-left: 60px;
        margin-top: 30px;
        padding-bottom: 30px;
    }

    .replyForm textarea {
        box-shadow: 5px 5px 5px #888888;
        padding: 15px;
        font-size: 10px;
        font-weight: 100;
    }

    .reply_form_buttons {
        margin-top: 10px;
        margin-right: 5px;
        padding: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
        font-weight: 100;
    }

    /*        #cancelButton {
            margin-left: 20px;
        }*/


    .replies {
        /*background-color: rgba(255, 252, 242, 0.80);*/
        background-color: white;
        /*font-size: 75%;*/
        margin-left: 60px;
        margin-right: 40px;
        /*width: 80%;*/
        padding-top: 15px;
        padding-bottom: 20px;
        padding-left: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        box-shadow: 5px 5px 5px #888888;
    }

    .replies h4 {
        padding-top: 0;
    }

    hr {
        /*width: 500px;*/
        height: 1px;
        /*color: black;*/
        background-color: black;
        margin-left: 20px;
        margin-right: 20px;
        /*border: 0.5px solid black;*/
    }

    #create_post_form {
        background-color: rgb(230, 230, 230);
        padding: 20px;
        padding-bottom: 30px;
        border-radius: 5px;
        margin-bottom: 50px;


    }

    #create_post_form textarea {
        color: rgb(120, 120, 120);
        font-size: 13px;
        font-weight: 100;
        padding: 15px;
        box-shadow: 5px 5px 5px rgb(130, 130, 130);
        width: 100%;
    }

    .form_buttons {
        margin-top: 20px;
        color: black;
        /*        background-color: rgb(200, 200, 200);*/
        background-color: rgba(255, 157, 45, 0.20);
        box-shadow: 3px 3px 3px rgb(130, 130, 130);
        border: 1px solid;
        font-size: 10px;
        font-weight: 100;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
        margin-right: 10px;


    }

    .form_buttons:hover {
        background-color: rgba(255, 157, 45, 0.50);
    }

    .post_background {
        padding-top: 20px;
        padding-bottom: 30px;
        /*background-color: green;*/
        margin-bottom: 30px;
        border-radius: 5px;
        background-color: rgb(230, 230, 230);
    }

    #div_tae {
        display: none;
    }

    .empty_div_shit {
        display: none;
    }

</style>






<!--Scripts-->
<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>

<!--<script src="_scripts/index.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Wall / FatBoy";
</script>










<?php
// TODO: SECTION: Script for posting a new post.
?>
<script>
    function create_post() {
        // Check if textarea is empty.
        if (is_textarea_empty(document.getElementById("message_post_textarea"))) {
            return;
        }


        // AJAX
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . "/public/__controller/controller_timeline_posts.php"; ?>";
        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText.trim().length > 0) {
//                    window.alert("puta ko: " + xhr.responseText.trim());

                    // Append the new post.
                    // This is just a "uniquer/clever" way of appending it..
                    // Ok it's not clever, but just "maparaan".
                    var new_div_background = document.createElement("div");
                    new_div_background.id = "newly_inserted_post";
                    new_div_background.setAttribute("class", "post_background");
                    new_div_background.innerHTML = xhr.responseText.trim();

                    //
                    var div_tae = document.getElementById("div_tae");
                    var middle_content = document.getElementById("middle_content");
                    middle_content.insertBefore(new_div_background, div_tae);

                    //
                    middle_content.removeChild(div_tae);

                    //
                    var new_div_tae = document.createElement("div");
                    new_div_tae.id = "div_tae";
                    middle_content.insertBefore(new_div_tae, new_div_background);

                    //
                    new_div_background.id = "";


                    // Clear the textarea.
                    document.getElementById("message_post_textarea").value = "";
                } else {
//                    window.alert("ajax returned empty");
                }

            }
        }


        //
        var post_key_value_pairs = "create_post=yes&";
        post_key_value_pairs += "message_post=" + document.getElementById("message_post_textarea").value.trim();

        xhr.send(post_key_value_pairs);


//        window.alert("puta");
    }

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
</script>












<?php
// TODO: SECTION: Script for showing the reply form.
?>
<script>
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
        replyForm.id = "replyForm";
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

        replyButton.onclick = create_reply_post;

        cancelButton.setAttribute("type", "button");
        cancelButton.setAttribute("value", "cancel");
        cancelButton.setAttribute("class", "form_buttons");

        cancelButton.id = "cancelButton";
//        cancelButton.innerHTML = "cancel";
        cancelButton.onclick = function () {
            document.getElementById(parentPostId).removeChild(replyForm);
//            document.getElementById(parentPostId).removeChild(cancelButton);
//            document.getElementById("replyButton" + parentPostId).style.backgroundColor = "rgba(255, 157, 45, 0.20)";

            // Re-enable the reply button.
            document.getElementById("replyButton" + parentPostId).removeAttribute("disabled");
        };


        replyForm.appendChild(replyTextAre);
//        replyForm.appendChild(parentPostHiddenInput);
        replyForm.appendChild(document.createElement("br"));
        replyForm.appendChild(replyButton);
//        replyForm.appendChild(document.createElement("br"));
        replyForm.appendChild(cancelButton);

//        document.getElementById(parentPostId).appendChild(replyForm);
        document.getElementById(parentPostId).insertBefore(replyForm, document.getElementById(parentPostId).childNodes[4]);
//    document.getElementById(parentPostId).appendChild(cancelButton);


    }

    function create_reply_post() {
//        window.alert("the_parent_post_id: " + the_parent_post_id);

        // AJAX
        var xhr = new XMLHttpRequest();
        var url = "<?php echo LOCAL . "/public/__controller/controller_timeline_post_replies.php"; ?>";
        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText.trim().length > 0) {

//                    $completely_presented_reply_post .= "<div id='{$row['id']}' class='replies'>";
                    var new_reply_post_div = document.createElement("div");
                    new_reply_post_div.className = "replies";
                    new_reply_post_div.innerHTML = xhr.responseText.trim();
//                    window.alert("ajas: " + xhr.responseText.trim());

                    // Remove the reply form.
                    document.getElementById(the_parent_post_id).removeChild(document.getElementById("replyForm"));


                    // Append the new reply post.
                    document.getElementById(the_parent_post_id).appendChild(new_reply_post_div);


                    // Change the color back of the reply button.
//                    document.getElementById("replyButton" + the_parent_post_id).style.backgroundColor = "rgba(255, 157, 45, 0.20)";


                    // Re-enable the reply button.
                    document.getElementById("replyButton" + the_parent_post_id).removeAttribute("disabled");

//        // Append.
//        var parent_node = document.getElementById(the_parent_post_id);
//        var new_div = document.createElement("div");
//        new_div.innerHTML = "bagong div";
//        var reference_node = parent_node.childNodes[4];
//        parent_node.insertBefore(new_div, reference_node);



                }
            }
        }


        //
        var post_key_value_pairs = "create_reply_post=yes";

        post_key_value_pairs += "&parent_post_id=" + the_parent_post_id;


        // Get the content of the textarea of the form that popped-up for reply.
        var reply_message = document.getElementById(the_parent_post_id).childNodes[4].childNodes[0].value;

        post_key_value_pairs += "&reply_message=" + reply_message.trim();


        xhr.send(post_key_value_pairs);
    }
</script>
















<!--Footer-->
<?php // include_layout_template('footer.php');      ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
