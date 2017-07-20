// Vars
var admin_tools_sub_menu_pop_up_timeout_handler = null;
var store_sub_menu_pop_up_timeout_handler = null;
var hiding_time = 2000;


// Tasks
add_mouseover_listeners_to_menus();
add_mouseout_listeners_to_menus();
add_mouseover_listeners_to_sub_menus();
add_mouseout_listeners_to_sub_menus();
// add_mouseover_listeners_to_sub_menus_links();
// add_mouseout_listeners_to_sub_menus_links();
// putangina();


// Functions

function add_mouseout_listeners_to_sub_menus_links() {
    //
    var sub_menu_links = document.getElementsByClassName("sub_menu_links");


    for (var i = 0; i < sub_menu_links.length; i++) {
        var sub_menu_link = sub_menu_links[i];

        if (sub_menu_link != null) {
            sub_menu_link.addEventListener("mouseout", function () {
                console.log("sub_menu_link:" + this.id + " has been mousedout.");

                var sub_menu = document.getElementById(this.parentElement.id);


                // Hide the popup.
                switch (sub_menu.id) {
                    case "admin_tools_sub_menu":
                        hide_sub_menu(admin_tools_sub_menu_pop_up_timeout_handler, this.parentElement);
                        break;
                    case "store_sub_menu":
                        hide_sub_menu(store_sub_menu_pop_up_timeout_handler, this.parentElement);
                        break;
                }

            });


        }
    }
}


function add_mouseover_listeners_to_sub_menus_links() {
    //
    var sub_menu_links = document.getElementsByClassName("sub_menu_links");


    for (var i = 0; i < sub_menu_links.length; i++) {
        var sub_menu_link = sub_menu_links[i];

        if (sub_menu_link != null) {
            sub_menu_link.addEventListener("mouseover", function () {
                // // Until sub_menu_pop_up_timeout_handler is not null,
                // // don't proceed to the next line of code cause
                // // it's gonna mess up the hiding of the sub-menus.
                // if (sub_menu_pop_up_timeout_handler != null) {
                //     my_main_sleep_callable(time_before_clearing_interval);
                // }


                //
                switch (this.parentElement.id) {
                    case "admin_tools_sub_menu":
                        clearTimeout(admin_tools_sub_menu_pop_up_timeout_handler);
                        break;
                    case "store_sub_menu":
                        clearTimeout(store_sub_menu_pop_up_timeout_handler);
                        break;
                }

                console.log("sub_menu_link:" + this.id + " has been mousedover.");

                this.parentElement.style.display = "block";
            });


        }
    }
}



function show_sub_menu(sub_menu) {

    switch (sub_menu.id) {
        case "admin_tools_sub_menu":
            clearTimeout(admin_tools_sub_menu_pop_up_timeout_handler);
            break;
        case "store_sub_menu":
            clearTimeout(store_sub_menu_pop_up_timeout_handler);
            break;
    }
    
    
    sub_menu.style.display = "block";
}


function hide_sub_menu(sub_menu) {
    switch (sub_menu.id) {
        case "admin_tools_sub_menu":
            admin_tools_sub_menu_pop_up_timeout_handler = setTimeout(function () {

                sub_menu.style.display = "none";

                console.log("*****************************");
                console.log("In METHOD:hide_sub_menu()");
                console.log("::>VAR:sub_menu.id:" + sub_menu.id);
            }, hiding_time);
            break;
        case "store_sub_menu":
            store_sub_menu_pop_up_timeout_handler = setTimeout(function () {

                sub_menu.style.display = "none";

                console.log("*****************************");
                console.log("In METHOD:hide_sub_menu()");
                console.log("::>VAR:sub_menu.id:" + sub_menu.id);
            }, hiding_time);
            break;
    }
}


function add_mouseout_listeners_to_sub_menus() {
    //
    var sub_menus = document.getElementsByClassName("sub_menus");

    console.log("sub_menus.length:" + sub_menus.length);

    for (var i = 0; i < sub_menus.length; i++) {
        var sub_menu = sub_menus[i];

        if (sub_menu != null) {
            sub_menu.addEventListener("mouseout", function () {
                console.log("EVENT:mouseout:" + this.id);


                // Hide the popup.
                hide_sub_menu(this);
            });

        }
    }
}


// uki
function add_mouseover_listeners_to_sub_menus() {
    //
    var sub_menus = document.getElementsByClassName("sub_menus");

    console.log("sub_menus.length:" + sub_menus.length);

    for (var i = 0; i < sub_menus.length; i++) {
        var sub_menu = sub_menus[i];

        if (sub_menu != null) {

            sub_menu.addEventListener("mouseover", function () {
                show_sub_menu(this);
            });


        }
    }
}




function add_mouseover_listeners_to_menus() {
    //
    var menus = document.getElementsByClassName("menus_with_sub_menus");


    for (var i = 0; i < menus.length; i++) {
        var menu = menus[i];

        if (menu != null) {
            menu.addEventListener("mouseover", function () {

                var menu_name = this.getAttribute("menu_name");

                // id for the sub_menu
                var id = menu_name + "_sub_menu";

                var sub_menu = document.getElementById(id);
                
                
                show_sub_menu(sub_menu);
            });


        }
    }
}


function add_mouseout_listeners_to_menus() {
    //
    var menus = document.getElementsByClassName("menus_with_sub_menus");


    for (var i = 0; i < menus.length; i++) {
        var menu = menus[i];

        if (menu != null) {
            menu.addEventListener("mouseout", function () {

                var menu_name = this.getAttribute("menu_name");

                // id for the sub_menu
                var id = menu_name + "_sub_menu";
                var sub_menu = document.getElementById(id);

                if (sub_menu != null) {
                    // Hide the popup.
                    hide_sub_menu(sub_menu);
                }
            });


        }
    }
}