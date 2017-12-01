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

function hide_element(el) {
    $(el).css("display", "none");
}

function show_element(el, display) {
    $(el).css("display", display);
}

function b_remove_animation(el, a) {
    el.classList.remove(a);
}

function b_add_animation(el, a) {
    el.classList.add(a);


}

/**
 *
 * @param embed_code
 * @param attribute
 * @return {attribute value or bool false}
 */
function get_attribute_value(embed_code, attribute) {
    var start_index = embed_code.indexOf(attribute);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (start_index == -1) { return false; }

    /*
     * For ex:
     *      $start_offset = "href" + "=\"";
     *                    = 4 + 2
     *                    = 6
     */
    start_index += attribute.length + 2;

    var end_index = embed_code.indexOf('"', start_index);

    // If the attribute is not present. eg (hre, hef, ref, and not href).
    if (end_index == -1) { return false; }

    // var attribute_value_length = end_index - start_index;

    var attribute_value = embed_code.substring(start_index, end_index);

    return attribute_value;
}

function get_date_of_latest_el(class_name, order) {

    var els = $("." + class_name);
    var length = els.length;

    var latest_el = null;
    if (order == "ASC") { latest_el = els[length - 1]; }
    else { latest_el = els[0]; }

    var latest_date = $(latest_el).attr("created-at");

    if (latest_el == null ||
        latest_date == null ||
        latest_date == "") {

        return "2010-09-11 10:54:45";
    }
    else {
        return latest_date;
    }
}