<?php // require_once("../private/includes/initializations.php");       ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php");       ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php");       ?>
<?php include("_layouts/header.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<main id="middle_content">

    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <!--I'm currently adding this for my store page.-->
        <a href="#">Sub-menu1</a>
        <a href="#">Sub-menu2</a>
    </nav>






    <?php
    echo "tae fatboy<br>";
    if ($session->is_logged_in()) {
        echo "Mothehfuckeh is logged-in.";
//    echo "<pre>";
//    print_r($session);
//    print_r($_SESSION);
//    echo "</pre>";
    } else {
        echo "Mothehfuckeh ain't logged-in.";
    }
    ?>





    <!--Meat-->
    <?php
// TODO: Show timeline notifications.
// TODO: A lot yet to be done. Timeline post form, timeline notification, etc.



    if ($session->is_logged_in()) {
//
        echo "<h3>Timeline";
        echo " {$session->currently_viewed_user_name}";
        echo "</h3><br>";


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
<!--<link href="<?php // echo LOCAL . '/public/_styles/header.css';     ?>" rel="stylesheet" type="text/css">-->
<!--<link href="<?php // echo LOCAL . '/public/_styles/index.css';     ?>" rel="stylesheet" type="text/css">-->
<style>
    main {
        border-radius: 10px;
        /*background-color: rgb(220, 220, 220);*/
        color: black;
    }

    #sub_menus_nav {
        border-radius: 5px;
        background-color: rgba(252, 224, 121, 0.80);
        color: black;
    }

    #sub_menus_nav a {
        color: black;
    }

    textarea {
        border-radius: 4px;
    }

    .message_post {
        /*background-color: rgba(153, 255, 153, 0.1);*/
        background-color: rgba(255, 252, 242, 0.95);
        width: 100%;
        /*padding: 10px;*/
        border-radius: 5px;
        padding-top: 20px;
        padding-bottom: 30px;
    }

    .message_post h4 {
        margin: 0;
        padding: 0;
        font-weight: 300;        
    }

    .message_post h5 {
        margin: 0;
        padding: 0;
        font-size: 60%;
        font-weight: 100;
        font-style: italic;
    }


    .message_post p {
        font-size: 90%;
        font-weight: 100;    
        margin-top: 20px;
    }



    .message_post h4,
    .message_post h5,
    .message_post p,
    .link_reply {
        margin-left: 20px;
    }


    .link_reply {
        color: black;
        background-color: rgb(200, 200, 200);
        font-size: 70%;
        font-weight: 100;
        /*padding: 10px;*/
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
    }

    .link_reply a {
        color: black;
        /*background-color: pink;*/
        padding: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        border-radius: 3px;
    }

    .replyForm {
        margin-left: 70px;
        margin-top: 30px;
    }
    
    .replyForm textArea {
        box-shadow: 5px 5px 5px #888888;
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
        margin-left: auto;
        margin-right: auto;
        width: 80%;
        padding-top: 20px;
        padding-bottom: 20px;
        border-radius: 5px;
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


</style>






<!--Scripts-->
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>

<!--<script src="_scripts/index.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<script>
    function createForm(parentPostId) {
        // Disable the reply button when the form shows up.
        document.getElementById("replyButton" + parentPostId).setAttribute("disabled", "disabled");

        var replyForm = document.createElement("form");
        var replyTextAre = document.createElement("textarea");
        var replyButton = document.createElement("input");
        var parentPostHiddenInput = document.createElement("input");
//        var cancelButton = document.createElement("button");
        var cancelButton = document.createElement("input");




        replyForm.setAttribute("action", "timeline_posts_reply.php");
        replyForm.setAttribute("method", "post");
        replyForm.setAttribute("class", "replyForm");

        replyTextAre.setAttribute("name", "reply_text_area");
        replyTextAre.setAttribute("rows", "4");
        replyTextAre.setAttribute("cols", "70");

        parentPostHiddenInput.setAttribute("type", "hidden");
        parentPostHiddenInput.setAttribute("name", "parent_post_id");
        parentPostHiddenInput.setAttribute("value", parentPostId);

        replyButton.setAttribute("type", "submit");
        replyButton.setAttribute("name", "submit");
        replyButton.setAttribute("value", "submit");
        replyButton.setAttribute("class", "reply_form_buttons");
        
        cancelButton.setAttribute("type", "button");
        cancelButton.setAttribute("value", "cancel");
        cancelButton.setAttribute("class", "reply_form_buttons");

        cancelButton.id = "cancelButton";
//        cancelButton.innerHTML = "cancel";
        cancelButton.onclick = function () {
            document.getElementById(parentPostId).removeChild(replyForm);
//            document.getElementById(parentPostId).removeChild(cancelButton);

            // Re-enable the reply button.
            document.getElementById("replyButton" + parentPostId).removeAttribute("disabled");
        };


        replyForm.appendChild(replyTextAre);
        replyForm.appendChild(parentPostHiddenInput);
        replyForm.appendChild(document.createElement("br"));
        replyForm.appendChild(replyButton);
//        replyForm.appendChild(document.createElement("br"));
        replyForm.appendChild(cancelButton);

        document.getElementById(parentPostId).appendChild(replyForm);
//    document.getElementById(parentPostId).appendChild(cancelButton);


    }
</script>





<!--Footer-->
<?php // include_layout_template('footer.php');   ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
