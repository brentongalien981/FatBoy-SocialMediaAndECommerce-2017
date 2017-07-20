// Vars.
var timeout_handler;
//            clearTimeout(myVar);






// Functions.
function close_pop_up_in_sec() {
    document.getElementById("pop_up_for_link_home").style.display = "none";
}





// Tasks.
document.getElementById("link_home").onmouseover = function () {
    //                window.alert("howver");
    clearTimeout(timeout_handler);
    document.getElementById("pop_up_for_link_home").style.display = "block";

};

document.getElementById("link_home").onmouseout = function () {
    timeout_handler = setTimeout(close_pop_up_in_sec, 500);

};

document.getElementById("pop_up_for_link_home").onmouseover = function () {
    //                window.alert("howver");
    clearTimeout(timeout_handler);
    document.getElementById("pop_up_for_link_home").style.display = "block";

};


document.getElementById("pop_up_for_link_home").onmouseout = function () {
    //                window.alert("howver");
    //                document.getElementById("pop_up_for_link_home").style.display = "block";
    timeout_handler = setTimeout(close_pop_up_in_sec, 500);


};

for (var i = 0; i < 2; i++) {
    if (document.getElementsByClassName("pop_up_links")[i] != null) {
        document.getElementsByClassName("pop_up_links")[i].onmouseover = function () {
            clearTimeout(timeout_handler);
            document.getElementById("pop_up_for_link_home").style.display = "block";
        };

    }


}



document.getElementById("pop_up_for_link_home").onmouseover = function () {
    //                window.alert("howver");
    clearTimeout(timeout_handler);
    document.getElementById("pop_up_for_link_home").style.display = "block";
    //                this.style.display = "block";
};