
<div id="the_body">
    <div id="main_div">
        <div id="chat_wall">
        </div>
        <textarea id="pseudo_textarea"></textarea>

        <div id="container_emoji">
            <?php
            for ($i = 128512, $j = 0; $i <= 128582; $i++, $j++) {
                if ($j == 8) {
                    echo "<br>";
                    $j = 0;
                }
                echo "<input id='{$i}' type='button' class='input_emoji' value='&#{$i};' onclick='append_emoji({$i})'>";
                //onclick='append_emoji({$i})'
            }
            ?>


        </div>

<!--        <textarea id="old_message_value"></textarea>-->
        <div id="container_input_send">
            <input type="button" id="input_send" value="send">
        </div>
    </div>

    <div id="container_output">tae</div>
    <div id="container_output2">0</div>
</div>













<script>
    function append_emoji(emoji_code) {
        var the_textarea = document.getElementById("pseudo_textarea");
        var presented_emoji = "&#" + emoji_code + ";";
        //&#032;
//        the_textarea.focus();

        the_textarea.innerHTML += presented_emoji;
//
//
//
//        var old_msg = document.getElementById("pseudo_textarea").innerHTML;
//
////        document.getElementById("pseudo_textarea").innerHTML = old_msg.substring(0, $('#container_output2').html()) + presented_emoji + old_msg.substring($('#container_output2').html());
//
        show_pop_up_effect(emoji_code);
        
        window.alert(<?php // htmlentities(; ?>the_textarea.value);
//        var msg = document.getElementById("pseudo_textarea").innerHTML;


//        document.getElementById("pseudo_textarea").focus();
        

    }

    function show_pop_up_effect(id_of_clicked_emoji) {
        var the_clicked_emoji = document.getElementById(id_of_clicked_emoji);
        var the_container_emoji = document.getElementById("container_emoji");
        var the_main_div = document.getElementById("main_div");
        var new_div = document.createElement("div");
        new_div.style.width = "15px";
        new_div.style.height = "15px";
        new_div.style.position = "absolute";
        new_div.style.backgroundColor = "yellow";
        new_div.style.textAlign = "center";
//        new_div.style.display = "table";
//        new_div.style.verticalAlign = "middle";
        new_div.style.padding = "10px";
//        new_div.style.zoom = "130%";
        new_div.id = "pautananaman";
        var offset_top = the_clicked_emoji.offsetTop - the_container_emoji.scrollTop - 35;
//        var offset_left = the_container_emoji.offsetLeft + the_clicked_emoji.offsetLeft;
        var offset_left = the_clicked_emoji.offsetLeft + (the_main_div.offsetLeft / 2) - 2;
        new_div.style.left = offset_left;
        new_div.style.top = offset_top
        new_div.innerHTML = "&#" + id_of_clicked_emoji + ";";
        the_container_emoji.appendChild(new_div);
//        document.getElementById("pseudo_textarea").innerHTML = document.getElementById("pseudo_textarea").innerHTML;




        setTimeout(function () {
            new_div.style.display = "none";
//            document.getElementById("pseudo_textarea").focus();
        }, 200);
        
//        var the_pseudo_textarea = document.getElementById("pseudo_textarea");
//        var message_being_typed = the_pseudo_textarea.innerHTML;//remove_div_tags(the_pseudo_textarea.innerHTML);
//        the_pseudo_textarea.innerHTML = message_being_typed;

    }

    function setEndOfContenteditable(contentEditableElement)
    {
        var range, selection;
        if (document.createRange)//Firefox, Chrome, Opera, Safari, IE 9+
        {
            range = document.createRange(); //Create a range (a range is a like the selection but invisible)
            range.selectNodeContents(contentEditableElement); //Select the entire contents of the element with the range
            range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
            selection = window.getSelection(); //get the selection object (allows you to change selection)
            selection.removeAllRanges(); //remove any selections already made
            selection.addRange(range); //make the range you have just created the visible selection
        } else if (document.selection)//IE 8 and lower
        {
            range = document.body.createTextRange(); //Create a range (a range is a like the selection but invisible)
            range.moveToElementText(contentEditableElement); //Select the entire contents of the element with the range
            range.collapse(false); //collapse the range to the end point. false means collapse to end rather than the start
            range.select(); //Select the range (make it the visible selection
        }
    }

</script>



<script src="jquery-3.2.1.js">
</script>


<script>
    var the_position_start, the_position_end;
    
    function getCaretPosition(editableDiv) {
        var caretPos = 0,
                sel, range;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount) {
                range = sel.getRangeAt(0);
                if (range.commonAncestorContainer.parentNode == editableDiv) {
                    caretPos = range.endOffset;
                }
            }
        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            if (range.parentElement() == editableDiv) {
                var tempEl = document.createElement("span");
                editableDiv.insertBefore(tempEl, editableDiv.firstChild);
                var tempRange = range.duplicate();
                tempRange.moveToElementText(tempEl);
                tempRange.setEndPoint("EndToEnd", range);
                caretPos = tempRange.text.length;
            }
        }
        return caretPos;
    }
    
    var update_cursor_position = function () {
//        $('#container_output2').html(getCaretPosition(this));
        $('#container_output2').html(function() {
//            window.alert();
            var position_start = document.getElementById("pseudo_textarea").selectionStart;
            var position_end = document.getElementById("pseudo_textarea").selectionEnd;
            
            the_position_start = position_start;
            the_position_end = position_end;
            
            $("#container_output2").html("position_start: " + position_start + " position_end: " + position_end);
        });
    };
//    $('#pseudo_textarea').on("mousedown mouseup keydown keyup", update_cursor_position);
    $('#pseudo_textarea').on("mousedown mouseup keydown keyup", update_cursor_position);
</script>









<style>
    #the_body {
        margin: 0;
        padding: 0;
        width: 100%;
        background-color: pink;
    }

    #pautananaman {
        /*vertical-align: middle;*/
        /*padding-top: 10px;*/
        /*cursor:*/ 
    }

    #main_div {
        /*        background-color: rgb(240, 240, 240);*/
        /*vertical-align: middle;*/
        width: 700px;
        margin-left: auto;
        margin-right: auto;
        padding: 10px;
        padding-left: 0px;
        padding-right: 0px;
        border-radius: 5px;
        background-color: rgb(227, 255, 224);

    }

    span.tae {
        background-color: yellow;
        /*cursor: d*/
    }

    span.putang_span {
        display: inline;
        /*        background-color: rgba(255, 255, 255, 0.0);*/
        background-color: yellow;
        /*padding: px;*/
        margin: 0;
        padding: 0;
        /*padding-top: -5px;;*/
        /*margin-bottom: -200px;*/
        /*vertical-align: bottom;*/
        vertical-align: baseline;
        /*margin: 10px;*/


    }

    .putang_span:hover {
        /*position: absolute;*/
        /*cursor: pointer;*/
        /*zoom: 300%;*/
    }

    #chat_wall {
        background-color: rgb(240, 240, 240);
        width: 500px;
        height: 200px;
        /*padding: 10px;*/
        border-radius: 5px;
        margin: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    #pseudo_textarea {
        display: block;
        background-color: rgb(250, 250, 250);
        border: none;
        font-family: helvetica;
        font-size: 12px;
        /*font-size: 4px;*/
        width: 350px;
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



    #container_emoji {
        background-color: pink;
        /*width: fit-content;*/

        /* These are to fit the content to specific browsers... */
        width: intrinsic;           /* Safari/WebKit uses a non-standard name */
        width: -moz-max-content;    /* Firefox/Gecko */
        width: -webkit-max-content; /* Chrome */
        /*display: table;*/
        height: 110px;
        margin: 20px;
        margin-left: auto;
        margin-right: auto;
        overflow-y: auto;
        /*        width: 500px;
                height: 600px; */
        zoom: 200%;
    }

    #old_message_value {
        /*display: none;*/
    }

    .input_emoji {
        width: 30px;
        height: 30px;
        padding: 2px;
        background-color: beige;
        border-radius: 3px;
        border: 0px solid white;
        /*zoom: 200%;*/
        /*zoom: 250%;*/
    }

    .input_emoji:hover {
        background-color: gray;
        cursor: pointer;
    }

    #container_input_send {
        width: 500px;
        margin-left: auto;
        margin-right: auto;
        /*background-color: rgb(150, 150, 150);*/
    }

    #input_send {
        /*display: block;*/
    }


</style>