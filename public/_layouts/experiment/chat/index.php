<?php require_once("read.php"); ?>


<!--Try loading scripts.-->
<script>
    /* tasks */
    $(document).ready(function(){
        $("#widgets-section").append($("#chat-widget-container"));
    });


    /* event_listener */
    $("#chat-widget-btn").click(function () {

//        toggleBtnState(this);
        clearInterval(cnHandler);
        cnHandler = null;
        console.log("tried to stop");
    });

</script>