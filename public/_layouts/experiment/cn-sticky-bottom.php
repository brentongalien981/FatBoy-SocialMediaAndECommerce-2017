<div id="toggle-view-section" class="cn-sticky-bottom fixed-bottom">
    <div class="cn-sticky-bottom-content d-inline-block">

        <button id="left-col-toggle-btn" type="button" class="btn btn-primary col-toggle-btn">
            <i class="fa fa-align-left"></i>
        </button>

        <button id="center-col-toggle-btn" type="button" class="btn btn-success col-toggle-btn">
            <i class="fa fa-align-center"></i>
        </button>

        <button id="right-col-toggle-btn" type="button" class="btn btn-primary col-toggle-btn">
            <i class="fa fa-align-right"></i>
        </button>

    </div>
</div>


<div id="widget-section" class="cn-sticky-bottom fixed-bottom text-right">

    <div id="widget-section-content" class="cn-sticky-bottom-content"></div>

</div>






<?php require_once("notification/index.php"); ?>
<?php require_once("chat/index.php"); ?>









<style>

    .cn-sticky-bottom {
        margin: 10px;
        padding: 0;
        /*max-width: 300px;*/
    }

    .cn-sticky-bottom button {
        box-shadow: 0 0 15px rgb(120, 120, 120);
    }

    .cn-sticky-bottom-content {
        background-color: yellow;
    }

    #toggle-view-section {
        display: none;

    }

    #widget-section {
        /*margin-left: 300px;*/
        background-color: lightblue;
        /*width: 200px;*/
    }

    .btn:hover {
        cursor: pointer;
    }

    /*Hide the #toggle-view-section on sm breakpoint*/
    @media screen and (max-width: 1199px) {
        #toggle-view-section {
            min-width: 150px;
            display: block;

        }
    }

    .widget {
        display: inline-block;
        margin-top: 10px;
        margin-left: 10px;
    }

    #widget-section-content {
        display: inline-block;
    }
</style>


<script>
    /* general_functions.js */
    function setWidgetSection() {
        $("#widget-section").css("margin-left", $(this).width() - $("#widget-section").width() - 10 + "px");
    }

    function setWidthOfCnStickyBottomSections() {
        //ish
        var cnStickyBottomSections = $(".cn-sticky-bottom");

        for (i = 0; i < cnStickyBottomSections.length; i++) {

            var currentSection = cnStickyBottomSections[i];

            var contentOfCurrentSection = $(currentSection).children()[0];
            $(currentSection).width($(contentOfCurrentSection).width() + 14);
        }
    }

    function resetColToggleBtns() {
        $(".col-toggle-btn").removeClass("btn-success");

        $(".col-toggle-btn").addClass("btn-primary");
    }

    function activateColToggleBtn(toggleBtnId) {
        $("#" + toggleBtnId).removeClass("btn-primary");

        $("#" + toggleBtnId).addClass("btn-success");
    }

    function activateCnCol(toggleBtnId) {

        $(".cn-col").css("display", "none");


        var activeCnColId = null;

        switch (toggleBtnId) {
            case 'left-col-toggle-btn':
                activeCnColId = "cn-left-col";
                break;
            case 'center-col-toggle-btn':
                activeCnColId = "cn-center-col";
                break;
            case 'right-col-toggle-btn':
                activeCnColId = "cn-right-col";
                break;
        }


        showCnCol(activeCnColId);
    }

    function showCnCol(activeCnColId) {
        console.log("activeCnColId: " + activeCnColId);
        $("#" + activeCnColId).css("display", "block");
    }

    function setWidthOfWidgetSectionContent() {
        var widgetWidth = $(".widget").width();

        var widgetCssMarginLeft = $(".widget").css("margin-left");
        var indexOfSuffixPx = widgetCssMarginLeft.indexOf("px");
        var widgetMarginLeft = widgetCssMarginLeft.substring(0, indexOfSuffixPx);

        if ($(this).width() <= (parseFloat(widgetWidth * 2) + parseFloat(widgetMarginLeft * 2))) {
            $("#widget-section-content").width(parseFloat(widgetWidth) + parseFloat(widgetMarginLeft));
        }
        else {
            $("#widget-section-content").width(parseFloat(widgetWidth * 2) + parseFloat(widgetMarginLeft * 2));
        }
    }

    /* ############################################################ */





    /* event_handlers */







    /* TASKS */
    $(document).ready(function () {


        /* tasks.js */
//        setDisplayAttribsOfWidgets();
//        widget-section-content
//        setWidthOfWidgetSectionContent();
        setWidthOfCnStickyBottomSections();
        setWidgetSection();



        /* event_listeners.js */
        $(window).resize(function () {
//            setDisplayAttribsOfWidgets();
//            setWidthOfWidgetSectionContent();
            setWidthOfCnStickyBottomSections();
            setWidgetSection();
        });

        $(".col-toggle-btn").click(function () {

            resetColToggleBtns();

            var toggleBtnId = $(this).attr("id");

            activateColToggleBtn(toggleBtnId);

            activateCnCol(toggleBtnId);

//            setWidthOfCnStickyBottomSections();
        });


    });


</script>
