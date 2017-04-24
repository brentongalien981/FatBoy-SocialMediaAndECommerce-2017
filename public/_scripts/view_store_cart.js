//function update_quantity_of_items() {
//    var default_action_url = "http://localhost/myPersonalProjects/FatBoy/public/__controller/controller_store_cart.php";
//    var length = document.getElementsByClassName("quantities").length;
//    var quantitiesForGetUrl = "?";
//    
//    window.alert("PUTA ASHIT");
//
//    for (var i = 0; i < length; i++) {
//        quantitiesForGetUrl = quantitiesForGetUrl +
//                document.getElementsByClassName("quantities")[i].id +
//                //                    i +
//                "=" +
//                document.getElementsByClassName("quantities")[i].value +
//                "&";
//
//    }
//
//
//    var form = document.getElementById("form");
//
////    var defaultUrl = "my_cart.php";
//
//    var updatedUrl = default_action_url + quantitiesForGetUrl;
//
//    form.setAttribute("action", updatedUrl);
//    //window.alert("updatedUrl: " + updatedUrl);
//
//    // Change the color of the button to red
//    // to notify the buyer that she needs to update the page.
//    document.getElementById("update_cart_items").setAttribute("style", "background-color: yellowgreen;");
//
//}