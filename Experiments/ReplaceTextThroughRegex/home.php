<div id="the_div"></div>
<script>
    var str = "&#12345;ZZZ&#128570;lex lksd $ &;l&#ea &&; kld &#128520;;";

    var patt = /&#[0-9]{6};/igm;
    var array_of_start_index_of_emojis = [];

    while (match = patt.exec(str)) {
        console.log(match.index + ' ' + patt.lastIndex);

        array_of_start_index_of_emojis.push(match.index);
    }



//    var the_msg = "hello sirs &#672382;lex";

    var the_presented_msg = "";

    for (var i = 0, j = 0; i < str.length; i++) {
        if (i == array_of_start_index_of_emojis[j]) {
            the_presented_msg += "<span>";
            
            the_presented_msg += str.charAt(i);
            continue;
        }

        if (i == (array_of_start_index_of_emojis[j] + 9)) {
            the_presented_msg += "</span>";
            the_presented_msg += str.charAt(i);
            ++j;
            continue;
        }

        the_presented_msg += str.charAt(i);



//        console.log(the_msg.charAt(i));
    }
//    document.createElement("div");
    
    console.log(the_presented_msg);
    
    
    document.getElementById("the_div").innerHTML = the_presented_msg;
//    window.alert(the_presented_msg);


//for (var i = 0; i < array_of_start_index_of_emojis.length; i++) {
//    console.log(array_of_start_index_of_emojis[i]);
//}
<?php
//echo the_presented_msg;
?>


</script>