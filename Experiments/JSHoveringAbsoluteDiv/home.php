<div style="display: inline; padding-right: 20px; background-color: green;">
    <img id="the_img" src="https://media.mnn.com/assets/images/2014/12/gray-squirrel-uc-berkeley.jpg.560x0_q80_crop-smart.jpg">
</div>

<style>
    #absolute_div {
        position: absolute;
        width: 560px;
        height: 373px;
        background-color: red;
        opacity: 0.5;
        margin: 0;
        padding: 0;
        display: inline;
    }

    #the_img {
        display: inline;
    }
</style>

<script
    src="https://code.jquery.com/jquery-3.2.1.js"
    integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
    crossorigin="anonymous">
</script>

<script>
    $('#the_img').mouseenter(function (event) {
        console.log("shits");
//    <div id="absolute_div"></div>
//        $('#absolute_div').css("display", "block");
        var absolute_div = document.createElement("div");
        absolute_div.id = "absolute_div";
        $(absolute_div).css("width", $('#the_img').css("width"));
        $(absolute_div).css("height", $('#the_img').css("height"));
//        $(absolute_div).insertAfter('#the_img');
        $(absolute_div).insertBefore('#the_img');


        $('#absolute_div').mouseleave(function (event) {
//        console.log("********************************");
//        console.log("EVENT: #absolute_div's mouseenter");
//        console.log("********************************");
//            var me = document.getElementById("absolute_div");
//            me.parentElement.removeChild(me);
            $(this).remove();
            console.log("removed");
        });

    });

    $('#the_img').click(function (event) {
        console.log("EVENT: #the_img's click");
    });

//    $('#absolute_div').mouseenter(function (event) {
//        console.log("********************************");
//        console.log("EVENT: #absolute_div's mouseenter");
//        console.log("********************************");
//    });



    $('#absolute_div').click(function (event) {
        console.log("EVENT: #absolute_div's click");
    });
</script>