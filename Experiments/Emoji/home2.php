
<div id="the_body">
    <div id="main_div">
        <div id="chat_wall">
        </div>

    <!--<textarea id="the_textarea"></textarea>-->

        <div id="pseudo_textarea" contenteditable="true"></div>
        <!--<textarea id="pseudo_textarea"></textarea>-->

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

            <!--<input type="hidden" id="old_message_value">-->

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


//    $(document).ready(function () {
//window.onload = function() {
//
//
//

//    var mouse_x;
//    var mouse_y;
//
//    var magnified_message_emoji = null;

    function z(str) {
        var patt = /&#[0-9]{6};/igm;
        var array_of_start_index_of_emojis = [];

        while (match = patt.exec(str)) {
            console.log(match.index + ' ' + patt.lastIndex + "\t\tLOOP");

            array_of_start_index_of_emojis.push(match.index);




        }

        console.log("method z() called.");
    }

//            var regex_pattern = /&#[0-9]{6};/igm;
    var array_of_start_index_of_emojis = [];


    function append_emoji(emoji_code) {
        var the_textarea = document.getElementById("pseudo_textarea");
//        var presented_emoji = "<span class='putang_span' onmouseout='remove_magnified_message_emoji()' onmouseover='magnify_typed_emoji(this)'>&#" + emoji_code + ";</span>";
        var presented_emoji = "&#" + emoji_code + ";";
        //&#032;



        var old_msg = document.getElementById("pseudo_textarea").innerHTML;
//        var new_msg = old_msg + presented_emoji;
//        var new_msg = old_msg + emoji_code;

        document.getElementById("pseudo_textarea").innerHTML = old_msg.substring(0, $('#container_output2').html()) + presented_emoji + old_msg.substring($('#container_output2').html());

        array_of_start_index_of_emojis.push($('#container_output2').html());

        show_pop_up_effect(emoji_code);


//        window.alert("POSITION OF CURSOR: " + $('#container_output2').html());
//        console.log(document.getElementById("pseudo_textarea").innerHTML);

        var msg = document.getElementById("pseudo_textarea").innerHTML;

//        document.getElementById("old_message_value").value = document.getElementById("old_message_value").innerHTML + msg;
//        z(msg);


        var presented_msg = "";

        for (var i = 0; i < msg.length; i++) {
//            console.log(msg.charAt(i));
//
//            if (i == 0) {
//                presented_msg += "<span>";
//                presented_msg += msg.charAt(i);
//                continue;
//            }
//            
//            
//                        if (i == 2) {
//                presented_msg += "</span>";
//                presented_msg += msg.charAt(i);
//                continue;
//            }



            presented_msg += msg.charAt(i);
        }

        console.log("presented_msg" + presented_msg);
        console.log("container_output2: " + $("#container_output2").html());

        for (var i = 0; i < array_of_start_index_of_emojis.length; i++) {
            console.log("array_of_start_index_of_emojis[" + i + "]: " + array_of_start_index_of_emojis[i]);
        }

//        window.alert(presented_msg);

//    var txt = document.createElement("textarea");
//    txt
//txt.id = "shitz";
//    txt.innerHTML = msg;
//    txt.value = msg;
//    decoded_msg = txt.value;

//document.getElementById("the_body").appendChild(txt);

//var shitz = $("#shitz").html(msg).html();
//var decoded_msg = document.getElementById("the_body").value;

//    var decoded_msg = document.getElementById("old_message_value").innerHTML = msg;

//
//        var encodedStr = msg.substring($('#container_output2').html(), $('#container_output2').html()+1).replace(/[\u00A0-\u9999<>\&]/gim, function (i) {
//            return '&#' + i.charCodeAt(0) + ';';
//        });
//        
//        String.fromCharCode(msg.substring(0, 3));

//        window.alert(msg);

//        window.alert("encodedStr: " + encodedStr);
//        console.log(txt.value);
//        console.log(txt.innerHTML);
//        
//        var the_clonez = document.getElementById("old_message_value");
//        the_clonez.id = "shit";
//        document.getElementById("the_body").appendChild(the_clonez);
//        the_clonez.innerHTML = txt.innerHTML;
    }

    function surround_chat_msg_emojis_with_span_tags() {
        var chat_msg_to_be_posted = $("#pseudo_textarea").html();
        
        console.log("chat_msg_to_be_posted.length: " + chat_msg_to_be_posted.length);

        var the_presented_msg = "";

        for (var i = 0, j = 0; i < chat_msg_to_be_posted.length;) {
            if (i == array_of_start_index_of_emojis[j]) {
                the_presented_msg += "<span>";

                the_presented_msg += chat_msg_to_be_posted.charAt(i);
                the_presented_msg += chat_msg_to_be_posted.charAt(i+1);
                
                the_presented_msg += "</span>";
                i += 2;
                ++j;
                continue;
            }
//
//            if (i == (array_of_start_index_of_emojis[j] + 2)) {
//                the_presented_msg += "</span>";
//                the_presented_msg += chat_msg_to_be_posted.charAt(i);
//                ++j;
//                continue;
//            }

            the_presented_msg += chat_msg_to_be_posted.charAt(i);
            ++i;



//        console.log(the_msg.charAt(i));
        }
//    document.createElement("div");

        // Reset the array.
        array_of_start_index_of_emojis = [];
        
        $("#pseudo_textarea").html("");

        console.log("the_presented_msg: " + the_presented_msg);
    }




//    window.alert("putatattagtattt");

//        var emoji_buttons_arr = document.getElementsByClassName("input_emoji");
//
//        for (var i = 0, emoji_code = 128512; i < emoji_buttons_arr.length; i++, emoji_code++) {
//            emoji_buttons_arr[i].onclick = function () {
//                append_emoji(emoji_code);
//            };
//        }






    function remove_magnified_message_emoji() {
//        setTimeout(function () {
        if (magnified_message_emoji != null) {
            magnified_message_emoji.style.display = "none";
            document.getElementById("the_body").removeChild(magnified_message_emoji);
            magnified_message_emoji = null;
        }
//        }, 100);
    }


    function magnify_typed_emoji(clicked_element) {
//
////
//
//        if ((mouse_x - clicked_element.offsetLeft) <= 18) {
////                window.alert("MAGNIFY!!!");
//
//
//
//
//
//            var the_main_div = document.getElementById("main_div");
//            var the_pseudo_textarea = document.getElementById("pseudo_textarea");
//            var new_div = document.createElement("div");
//            new_div.style.display = "inline";
//            new_div.innerHTML = "&#128512;";
////        new_div.style.width = "15px";
////        new_div.style.height = "15px";
//            new_div.style.position = "relative";
//            new_div.style.backgroundColor = "yellow";
//            new_div.style.textAlign = "center";
////        new_div.style.display = "table";
////        new_div.style.verticalAlign = "middle";
//            new_div.style.padding = "5px";
//            new_div.style.zIndex = 3;
////        new_div.style.zoom = "200%";
////        new_div.style.zoom = "130%";
////        new_div.id = "pautananaman";
//
////        var offset_top = the_clicked_emoji.offsetTop - the_container_emoji.scrollTop - 35;
////        var offset_left = the_container_emoji.offsetLeft + the_clicked_emoji.offsetLeft;
////        var offset_left = the_clicked_emoji.offsetLeft + (the_main_div.offsetLeft / 2) - 2;
//
//
//            new_div.style.left = "0px"; //clicked_element.offsetLeft;
////new_div.style.left = clicked_element.left;
//            new_div.style.top = "0px"; //clicked_element.offsetTop
////        new_div.innerHTML = "&#" + id_of_clicked_emoji + ";";
//
//
//            clicked_element.appendChild(new_div);
////        new_div.style.position = "absolute";
//
//
//
//
//            var cln = new_div.cloneNode(true);
//            cln.style.position = "absolute";
////        cln.style.left = (new_div.offsetLeft - 150) + "px";
////        cln.style.top = (new_div.offsetTop - 150) + "px";
////        cln.style.paddingTop = "0";
////        cln.style.paddingLeft = "0";
//            cln.style.padding = "0";
//            cln.style.left = (new_div.offsetLeft - new_div.offsetLeft / 2 - clicked_element.offsetWidth / 2 + 16) + "px";
//            cln.style.top = new_div.offsetTop - new_div.offsetTop / 2 - the_pseudo_textarea.scrollTop / 2 + "px";
////        cln.style.backgroundColor = "rgba(255, 255, 255, 0.0)";
//            cln.style.backgroundColor = "beige";
//            cln.style.zoom = "200%";
////        
////        window.alert("new_div: " + clicked_element.offsetWidth);
////        window.alert("new_div: " + new_div.offsetLeft);
////        window.alert("cln.: " + new_div.offsetLeft);
//
//            document.getElementById("the_body").appendChild(cln);
//
//            magnified_message_emoji = cln;
////document.appendChild(cln);
//
//
//            new_div.style.display = "none";
//            clicked_element.removeChild(new_div);
//
//            clicked_element.style.cursor = "pointer";
//
////            clicked_element.onmouseout = function () {
////                cln.style.display = "none";
////                document.getElementById("the_body").removeChild(cln);
//////                window.alert("YOU'RE HOVERING BUT not on the image");
////
////            };
//
//        } else {
//            clicked_element.style.cursor = "text";
//        }
//
//
//
//        document.getElementById("container_output2").innerHTML = document.getElementById("pseudo_textarea").innerHTML;
    }

    function show_pop_up_effect(id_of_clicked_emoji) {
//                div_result.innerHTML = "left: " + the_span.getBoundingClientRect().left + "<br>" +
//                               "top: " + the_span.getBoundingClientRect().top + "<br>" + 
//                               "right: " + the_span.getBoundingClientRect().right;


//            window.alert("BEFORE:\n" + document.getElementById("pseudo_textarea").innerHTML);





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
        }, 250);
        var the_pseudo_textarea = document.getElementById("pseudo_textarea");
        var message_being_typed = remove_div_tags(the_pseudo_textarea.innerHTML);
        the_pseudo_textarea.innerHTML = message_being_typed;
//        
//        the_pseudo_textarea.innerHTML = remove_div_tags(message_being_typed);


        // Put the cursor at the end of the current message being typed.
        // From stackoverflow.
        setEndOfContenteditable(document.getElementById("pseudo_textarea"));
//            window.alert("AFTER:\n" + document.getElementById("pseudo_textarea").innerHTML);



//        window.alert("offsetTop: " + offset_top);
//        window.alert("offsetLeft: " + offset_left);
//        var the_container_output = document.getElementById("container_output");
//        the_container_output.innerHTML = "the_main_div: " + the_main_div.offsetLeft;
    }

    function br2nl(varTest) {
        return varTest.replace(/<br\s*\/?>/ig, "\r");
    }

    function remove_div_tags(the_str) {
        var replacement = "";
        var the_replacement = the_str.split("<div>").join("<br>");
        the_replacement = the_replacement.split("</div>").join("");
        the_replacement = the_replacement.split("&nbsp;").join(" ");
        the_replacement = the_replacement.split("<br><br>").join("<br>");
//        the_replacement = the_replacement.split("<br></span>").join("</span>");
//        the_replacement = the_replacement.split(";").join("");
//        the_replacement = the_replacement.split("<y0ldz></y0ldz>").join("");
//        the_replacement = the_replacement.split("</span>").join("");

// <y0ldz></y0ldz>


//        the_replacement = the_replacement.split("&nbsp;").join("");

        return the_replacement;
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







    // Anonymouse events.
    document.getElementById("input_send").onclick = function () {
        surround_chat_msg_emojis_with_span_tags();
    };


</script>



<script src="jquery-3.2.1.js">
</script>


<script>
    $(document).ready(function () {
        window.alert("shit");
        $("#the_body").mousemove(function (event) {
            var msg = "Handler for .mousemove() called at ";
            msg += event.pageX + ", " + event.pageY;
            $("#container_output").html("MSG: " + msg);
            mouse_x = event.pageX;
            mouse_y = event.pageY;
        });
    });

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

    function func_tae() {
        window.alert("CLICK INPUT SEND");
    }


    var update_cursor_position = function () {
        $('#container_output2').html(getCaretPosition(this));
    };
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
    /*
        #pseudo_textarea div {
            display: inline;
        }
        
            #pseudo_textarea p {
            display: inline;
        }
        
                #pseudo_textarea span {
            display: inline;
        }
    
    
        pre{
            white-space: pre-wrap;
            background: #EEE;
        }*/

    /*    .putang_span div{
            background: skyblue;
            padding:10px;
            display: inline-block;
        }*/

    /*    #pseudo_textarea pre{
            white-space: pre-wrap;
            background: #EEE;
        }*/

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
        /*display: block;*/
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

    /*    .input_emoji:active { 
            position: absolute;
        background-color: yellow;
        zoom: 400%;
    }*/

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