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