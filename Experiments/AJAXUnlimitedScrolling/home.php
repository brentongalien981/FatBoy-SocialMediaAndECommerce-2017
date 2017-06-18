<style>
    #outer_div {
        /*margin-top: 200px;*/
        width: 500px;
        height: 500px;
        background-color: pink;
        overflow-y: auto;
    }

    .inner_divs {
        width: 300px;
        height: 200px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
        background-color: yellow;
    }
    
    .blue_div {
        background-color: blue;
    }
</style>

<div id="outer_div">
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <?php 
        if ($i == 8) {
            echo "<div id='blue_div' class='inner_divs blue_div'>";
            echo $i;
            echo "</div>";
            continue;
        } 
        ?>
        <div class="inner_divs">
            <?php echo $i; ?>
        </div>
    <?php } ?>
</div>


<script>
    window.onload = function () {
        var outer_div = document.getElementById('outer_div');
        var blue_div = document.getElementById('blue_div');
        var outer_div_bounds = outer_div.getBoundingClientRect();
        var blue_div_bounds = blue_div.getBoundingClientRect();


        function scrollReaction() {
            // Height of the element.
            var outer_div_offsetHeight = outer_div.offsetHeight;
//        var current_y = window.innerHeight + window.pageYOffset;
//        // console.log(current_y + '/' + content_height);
//        if (current_y >= content_height) {
//            loadMore();
//        }



            console.log("outer_div_offsetHeight: " + outer_div_offsetHeight);
            
            console.log("window.innerHeight: " + window.innerHeight);
            console.log("blue_div_bounds.top: " + blue_div_bounds.top);        
            console.log("outer_div.scrollTop: " + outer_div.scrollTop);   
            
            // blud_div's relative position to the container.
            var blue_div_rel_pos = blue_div_bounds.top - outer_div_bounds.top - outer_div.scrollTop;
            console.log("blue_div_rel_pos: " + blue_div_rel_pos);
            
            if (blue_div_rel_pos <= (outer_div_offsetHeight + 50)) {
                console.log("LABAS NA");
            }
            
            
        }
        
        window.onresize = function() {
            console.log("window.innerHeight: " + window.innerHeight);
            console.log("window.innerWidth: " + window.innerWidth);
        };

        outer_div.onscroll = function () {
            scrollReaction();
        }
        
        console.log("tae");
    };
</script>