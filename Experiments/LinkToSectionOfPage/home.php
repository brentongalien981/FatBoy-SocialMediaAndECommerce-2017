<?php

for ($i = 0; $i < 20; $i++) {
    echo "<div id='{$i}'>";
    echo $i;
    echo "</div>";
}

?>

<br>
<a href="#3" id="link">go to div 3</a>

<style>
    div {
        width: 80%;
        height: 100px;
        margin: 10px;
        background-color: yellow;
    } 
    </style>
    
    <script>
        document.getElementById("link").onclick = function () {
//            window.alert("clicked");
            
            document.getElementById("3").style.background = "red";
        };
    </script>