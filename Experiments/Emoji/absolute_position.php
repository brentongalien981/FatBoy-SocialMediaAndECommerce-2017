<div id="main_div">
    ano <br>
    ano <br>
    ano <br>
    tae tae <span id="the_span">shit</span> tae ulit<br>
    ano na?
</div>

<div id="div_result">
    
</div>





<script>
    var div_result = document.getElementById("div_result");
    
    var the_span = document.getElementById("the_span");
    
    document.getElementById("the_span").onmouseover = function() {
//        window.alert("tae");
        
        div_result.innerHTML = "left: " + the_span.getBoundingClientRect().left + "<br>" +
                               "top: " + the_span.getBoundingClientRect().top + "<br>" + 
                               "right: " + the_span.getBoundingClientRect().right;
                       
        var new_div = document.createElement("div");
        new_div.style.width = "50px";
        new_div.style.height = "50px";
        new_div.style.position = "absolute";
        new_div.style.backgroundColor = "red";
        new_div.style.left = the_span.getBoundingClientRect().left + "px";
        new_div.style.top = (the_span.getBoundingClientRect().top - 50) + "px";
        new_div.innerHTML = "&#128512;";
        
        
        the_span.appendChild(new_div);
        
        
        /*
         * var rect = element.getBoundingClientRect();
console.log(rect.top, rect.right, rect.bottom, rect.left);
         */
    };
</script>






<style>
    #main_div {
        width: 500px;
        height: 500px;
        background-color: rgb(240, 240, 240);
    }
    
    #div_result {
                width: 500px;
        height: 100px;
        background-color: yellow;
    }
    
    span:hover {
        cursor: pointer;
    }
    </style>