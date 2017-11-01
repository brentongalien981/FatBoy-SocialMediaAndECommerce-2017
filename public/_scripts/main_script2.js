function my_sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function maximize_main_content() {
    $("#right").css("display", "none");
    // $("#main_content").css("width", "1000px");

    $("#middle_content").css("width", "1110px");
    $("#middle_content").css("min-width", "1110px");

    $("#main_content").css("width", "100%");
    $("#main_content").css("min-width", "100%");
}

function minimize_main_content() {
    $("#right").css("display", "initial");
    // $("#main_content").css("width", "1000px");

    $("#middle_content").css("width", "initial");
    $("#middle_content").css("min-width", "initial");

    $("#main_content").css("width", "initial");
    $("#main_content").css("min-width", "initial");
}