<!--Imports-->
<!--File initializations.php and session.php is already included in header.php.-->
<?php // require_once("../_layouts/header.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_chat.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to("view_log_in.php");
}
?>












<!--Meat-->
<div id="chat_pod" class="section">
    <div id="chat_wall">
        <?php
        show_completely_presented_chat_msgs();
        ?>
    </div>

    <textarea id="the_textarea"></textarea>

    <div id="reference"></div>
    <div id="container_of_pictographs">
        <div id="inner_container_of_pictographs">

            <?php
            for ($i = 128512, $j = 0; $i <= 128582; $i++, $j++) {
                if ($j == 8) {
                    echo "<br>";
                    $j = 0;
                }
                echo "<input id='{$i}' type='button' class='input_pictographs' value='&#{$i};' onclick='append_emoji({$i})'>";
                //onclick='append_emoji({$i})'
            }
            ?>
        </div>
    </div>

    <div id="panel_chat_buttons">
        <nav id="nav_chat_buttons">
            <input type="image" id="input_send" src="<?php echo LOCAL . "/public/_photos/icon_send.png"; ?>" class="chat_buttons">
            <input type="image" src="<?php echo LOCAL . "/public/_photos/icon_smiley.png"; ?>" class="chat_buttons">
            <input type="hidden" id="input_cursor_position">
        </nav>
    </div>
</div>













<!--Styles-->
<!--<link href="../_styles/view_my_videos.css" rel="stylesheet" type="text/css" />-->
<style>
    
    a#sub_nav_chat_window {
        color: rgb(194, 255, 119);
        /*color: black;*/
        background-color: rgb(70, 70, 70);
    }

    div.section {
        /*background-color: rgb(200, 200, 200);*/
        /*background-color: rgb(150, 150, 150);*/
        background-color: rgb(220, 220, 220);
        width: 600px;
        margin: 30px;
        padding-top: 30px;
        border-radius: 5px;
        /*box-shadow: 5px 5px 5px rgb(150, 150, 150);*/
        box-shadow: 5px 5px 5px rgb(150, 150, 150);
    }

    #chat_pod {
        /*box-shadow: 5px -5px 5px rgb(150, 150, 150);*/
        
    }

    #chat_wall {
        background-color: rgb(245,245, 245);
        width: 470px;
        height: 280px;
        padding: 10px;
        overflow-y: auto;
        /*overflow-x: no-content;*/
        /*word-wrap: break-word;*/
        border-radius: 5px;
        margin: 20px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
    }

    div.chat_post {
        /*background-color: rgb(242, 252, 255);*/
/*        background-color: rgb(230, 252, 255);*/
        border-radius: 15px;
        width: fit-content;
        max-width: 360px;
        margin: 5px;
        /*margin-right: 5%;*/

        /*margin-left: 100%;*/

        padding: 0;

        float: left;

        /*text-align: center;*/
        clear: both;
        /*max-width: 80%;*/
        word-wrap: break-word;
    }

    div.user_chat_post {
/*        background-color: rgb(224, 255, 193);*/
        float: right;
        /*word-wrap: break-word;*/

        /*white*/
    }

    div.chat_post h5 {
        font-size: 11px;
        font-weight: 100;
    }

    div.chat_post img {
        width: 24px;
        height: 24px;
        float: left;
        /*background-color: yellow;*/
        border-radius: 12px;
/*        padding: 0;
        padding-right: 6px;*/
        margin: 0;
        margin-right: 6px;
        box-shadow: 3px 3px 3px rgb(150, 150, 150);
    }

    div.chat_post img.user_chatter_img {
        float: right;
/*        padding: 0;
        padding-left: 6px;*/
        margin: 0;
        margin-left: 6px;
    }

    div.chat_post p {
        font-size: 12px;
        font-weight: 100;
        float: left;
        max-width: 300px;
        /*word-wrap: break-word;*/
        white-space: pre-line;
        padding: 15px;
        padding-top: 10px;
        /*background-color:*/ 
        /*background-color: rgb(224, 255, 193);*/
        background-color: rgb(230, 252, 255);
        border-radius: 15px;
        box-shadow: 3px 3px 3px rgb(150, 150, 150);
    }

    div.chat_post p.actual_user_msg {
        float: right;
        background-color: rgb(224, 255, 193);
        /*white-space: pre-line;*/
    }

    span.span_emoji {
        margin: 0;
        padding: 0;
        padding-left: 1px;
        padding-right: 1px;
        background-color: inherit;
        color: black;
        /*zoom: 200%;*/
    }

    #the_textarea {
        display: block;
        background-color: rgb(245,245, 245);
        /*border: none;*/
        font-size: 11px;
        /*font-size: 4px;*/
        width: 370px;
        height: 100px;
        padding: 10px;
        padding-top: 15px;
        margin-top: 15px;
        border-radius: 5px;
        margin-left: auto;
        margin-right: auto;
        overflow-y: auto;
        /*font-kerning: normal;*/
        line-height: 150%;
        /*zoom: 110%;*/
    }

    div#reference {
        display: none;
    }

    #container_of_pictographs {
        margin-top: 15px;
        background-color: rgb(100, 100, 100);
        width: 100%;
        height: 87px;
        overflow-y: auto;
        zoom: 200%;
    }

    #inner_container_of_pictographs {
        /*margin-top: 30px;*/
        margin-left: auto;
        margin-right: auto;
        background-color: rgb(103, 103, 103);
        padding-left: 20px;
        padding-right: 20px;
        width: intrinsic;           /* Safari/WebKit uses a non-standard name */
        width: -moz-max-content;    /* Firefox/Gecko */
        width: -webkit-max-content; /* Chrome */
        height: intrinsic;           /* Safari/WebKit uses a non-standard name */
        height: -moz-max-content;    /* Firefox/Gecko */
        height: -webkit-max-content; /* Chrome */
        /*overflow-y: auto;*/
        /*zoom: 200%;*/
    }

    input.input_pictographs {
        width: 25px;
        height: 25px;
        padding: 2px;
        background-color: rgb(103, 103, 103);
        border-radius: 3px;
        /*border: 0px solid white;*/
    }

    input.input_pictographs:hover {
        background-color: rgb(120, 120, 120);
        cursor: pointer;
    }

    #panel_chat_buttons {
        margin-top: 1px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        background-color: rgb(150, 150, 150);
        width: 100%;
        height: 40px;
    }

    #nav_chat_buttons {
        /*background-color: rgb(80, 80, 80);*/
        padding: 5px;
        margin-left: 10px;
        margin-right: 10px;
        /*background-color: orange;*/
        height: 40px;
    }



    input.chat_buttons {
        /*background-color: red;*/
        background-color: rgb(170, 170, 170);
        border-radius: 5px;
        margin-right: 10px;
        /*margin-top: 3px;*/
        /*margin-bottom: 3px;*/
        width: 20px;
        height: 20px;
        padding: 5px;
        padding-left: 35px;
        padding-right: 35px;
    }

    input.chat_buttons:hover {
        background-color: rgb(224, 255, 193);
    }
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_my_videos.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Chat Window / FatBoy";
</script>










<script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
</script>


<script>
    // Global variables
    var interval_handle;
    var update_interval = 3000;

    $(document).ready(function () {
//        window.alert("jquery is ready!");

        set_textarea_listener();

        set_send_listener();

        interval_handle = setInterval(start_chat_msg_fetcher, update_interval);
    });

    function set_textarea_listener() {
        $('#the_textarea').on("mousedown mouseup keydown keyup", update_the_cursor_position_value);
    }

    function set_send_listener() {
        document.getElementById("input_send").onclick = function () {
            var chat_msg = document.getElementById("the_textarea").value;

            if (chat_msg.trim().length <= 0) {
                return;
            }

            post_chat_msg(chat_msg);

            // Clear the textarea.
            document.getElementById("the_textarea").value = "";

            // LOG:
            console.log("Inside method set_send_listener().");
        };
    }


</script>















<script>
    function start_chat_msg_fetcher() {
        var xhr = new XMLHttpRequest();

        var url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_chat.php";

        xhr.open('POST', url, true);
        // You need this for POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            console.log('readyState: ' + xhr.readyState);
            if (xhr.readyState == 2) {
//            target.innerHTML = 'Loading...';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {

                // Basically, if there's an actual values echoed or returned in html form,
                // do something.
                if (xhr.responseText.trim().length > 0) {

                    var the_new_div = document.createElement("div");

                    var finalized_chat_msg = xhr.responseText.trim();

                    // If it's the actual user who posted the chat msg....
                    if (finalized_chat_msg.charAt(0) == "1") {
                        the_new_div.className = "chat_post user_chat_post";
                    } else {
                        the_new_div.className = "chat_post";
                    }


                    var date_posted_substr = finalized_chat_msg.substring(1, 20);
                    the_new_div.setAttribute("title", date_posted_substr);

                    // Remove the first char owner-flag-code...
                    finalized_chat_msg = finalized_chat_msg.substring(20);


                    // Surround emojis with tag "span".
                    finalized_chat_msg = surround_chat_msg_emojis_with_span_tags(finalized_chat_msg);

                    the_new_div.innerHTML = finalized_chat_msg;
                    document.getElementById("chat_wall").appendChild(the_new_div);


                    // LOG.
                    console.log("xhr.responseText.trim(): " + xhr.responseText.trim());
                    console.log("finalized_chat_msg after surround(): " + finalized_chat_msg);
                    console.log("Inside method start_chat_msg_fetcher().");
                }


            }
        }

        var post_key_value_pairs = "chat_msg_fetcher=active";
        xhr.send(post_key_value_pairs);

    }

    function post_chat_msg(chat_msg) {
        // AJAX
        var xhr = new XMLHttpRequest();

        var url = "<?php echo LOCAL . '/public/__controller/controller_chat.php'; ?>";
        xhr.open('POST', url, true);
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            // If ready..
            if (xhr.readyState == 4 && xhr.status == 200) {

                // If there's a successful response..
                if (xhr.responseText.trim().length > 0) {
                    // TODO: LOG: console.log("chat message posted: " + xhr.responseText.trim());
                    console.log("chat message posted: " + xhr.responseText.trim());
                } else {
                }

            }
        }


        //
        var post_key_value_pairs = "chat_msg=" + chat_msg;
        xhr.send(post_key_value_pairs);
    }

    function surround_chat_msg_emojis_with_span_tags(chat_msg) {
//        var chat_msg = document.getElementById("the_textarea").value;

        var the_presented_msg = "";

        for (var i = 0; i < chat_msg.length; ) {
            if (chat_msg.charCodeAt(i) > 255) {
                the_presented_msg += "<span class='span_emoji'>";

                // Html renders html entities/emojis as 2 unicode chars.
                the_presented_msg += chat_msg.charAt(i);
                the_presented_msg += chat_msg.charAt(i + 1);

                the_presented_msg += "</span>";

                // 2 unicode chars added to the_presented_msg, so hop on two chars.
                i += 2;

                continue;
            }

            // For regular chars, just simply add 'em to the message.
            the_presented_msg += chat_msg.charAt(i);
            ++i;
        }

        return the_presented_msg;
    }

    function setSelectionRange(input, selectionStart, selectionEnd) {
        if (input.setSelectionRange) {
            input.focus();
            input.setSelectionRange(selectionStart, selectionEnd);
        } else if (input.createTextRange) {
            var range = input.createTextRange();
            range.collapse(true);
            range.moveEnd('character', selectionEnd);
            range.moveStart('character', selectionStart);
            range.select();
        }
    }


    function setCaretToPos(input, pos) {
        setSelectionRange(input, pos, pos);
    }

    function update_the_cursor_position_value() {
        var current_cursor_position = $('#the_textarea').prop("selectionStart");

        document.getElementById("input_cursor_position").value = current_cursor_position;
    }

    function get_the_cursor_position_value() {
        return document.getElementById("input_cursor_position").value;
    }

    function show_pop_up_effect(id_of_clicked_emoji) {
        var the_clicked_emoji = document.getElementById(id_of_clicked_emoji);
        var container_of_pictographs = document.getElementById("container_of_pictographs");
        var chat_pod = document.getElementById("chat_pod");

        var new_div = document.createElement("div");
        new_div.style.width = "15px";
        new_div.style.height = "15px";
        new_div.style.position = "absolute";
        new_div.style.borderRadius = "5px";
        new_div.style.backgroundColor = "rgb(224, 255, 193)";
        new_div.style.textAlign = "center";
        new_div.style.padding = "10px";

        var offset_top = the_clicked_emoji.offsetTop - container_of_pictographs.scrollTop + 35;
        var offset_left = the_clicked_emoji.offsetLeft + (145);

        new_div.style.left = offset_left;
        new_div.style.top = offset_top
        new_div.innerHTML = "&#" + id_of_clicked_emoji + ";";


        container_of_pictographs.appendChild(new_div);




        setTimeout(function () {
            container_of_pictographs.removeChild(new_div);
        }, 250);
    }

    function append_emoji(emoji_code) {
        var the_chat_pod = document.getElementById("chat_pod");
        var the_textarea = document.getElementById("the_textarea");
        var presented_emoji = "&#" + emoji_code + ";";
        var old_msg = document.getElementById("the_textarea").value;
        var div_reference = document.getElementById("reference");
        var cursor_position = get_the_cursor_position_value();
        var chat_msg = old_msg.substring(0, cursor_position) + presented_emoji + old_msg.substring(cursor_position);


        the_chat_pod.removeChild(the_textarea);


        var the_new_textarea = document.createElement("textarea");
        the_new_textarea.id = "the_textarea";
        the_new_textarea.innerHTML = chat_msg;


        //
        the_chat_pod.insertBefore(the_new_textarea, div_reference);

        //
        set_textarea_listener();



        // +2 because html convert html entities to unicode that has length 2.
        var new_cursor_position = parseInt(cursor_position) + 2;
        setCaretToPos(the_new_textarea, new_cursor_position);
        the_new_textarea.focus();


        //
        show_pop_up_effect(emoji_code);

//        console.log("NEW VALUES:");
//        console.log("the_new_textarea.innerHTML: " + the_new_textarea.innerHTML);
//        console.log("the_new_textarea.value: " + the_new_textarea.value);
//        console.log("the_new_textarea.value.length: " + the_new_textarea.value.length);
    }
</script>















