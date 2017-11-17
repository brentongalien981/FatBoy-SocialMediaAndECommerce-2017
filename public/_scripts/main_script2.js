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

function mcnLogObject(obj) {

    /**/
    console.log("###########################");
    console.log("IN METHOD mcnLogObject()");
    
    /**/
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            var val = obj[key];

            // Display in the console.
            console.log(key + " => " + val);
        }
    }

    console.log("###########################");
}

function set_loader_el(container_id, loading_comment) {

    //
    $("#" + container_id).append($("#mcn-loader-el"));
    $("#mcn-loader-el").find("#loading-comment").html(loading_comment);
    $("#mcn-loader-el").css("display", "block");
}

function unset_loader_el() {

    //
    $("#mcn-loader-el").css("display", "none");
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}