function show_flash_notification(x_obj, json) {

    //
    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }


    // TODO:REMINDER: Make the notification more presentable in production.
    if (json == null || !json.is_result_ok) {
        // FAIL on [crud]ing [x]Notification.
        // window.alert("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("FAIL on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
    else {
        // SUCCESS on [crud]ing [x]Notification.
        // window.alert("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
        console.log("SUCCESS on " + x_obj.crud_type + "ing " + x_obj.class_name);
    }
}


/**
 * Get the subfolder of the appropriate xAjaxHandler.php.
 * @param class_name
 * @return {string}
 */
function get_subfolder(class_name) {
    //
    var subfolder = "";

    switch (class_name) {
        case "FriendshipSuggestion":
            subfolder = "friends";
            break;
        case "FriendshipAcolyte":
            subfolder = "friends";
            break;
        case "FriendshipMuse":
            subfolder = "friends";
            break;
        case "Friendship":
            subfolder = "friends";
            break;
        case "NotificationFriendship":
        // subfolder = "notifications";
        // break;
        case "NotificationMyShopping":
        // subfolder = "notifications";
        // break;
        case "NotificationPost":
        // subfolder = "notifications";
        // break;
        case "NotificationTimelinePostReply":
        // subfolder = "notifications";
        // break;
        case "NotificationRateableItem":
            subfolder = "notifications";
            break;
        case "User":
            subfolder = "admin_tools/user_management";
            break;
        case "Photo":
            subfolder = "my_photos";
            break;
        case "RateableItem":
            subfolder = "rateable_items";
            break;
        case "RateableItemUser":
            subfolder = "rateable_items_users";
            break;
        case "ChatList":
            subfolder = "chat_list";
            break;
        case "ChatMessage":
            subfolder = "chat_message";
            break;
        case "AppSetting":
            subfolder = "app_settings";
            break;
        case "TimelinePost":
            subfolder = "timeline_posts";
            break;
        case "TimelinePostSubscription":
            subfolder = "timeline_post_subscriptions";
            break;
        case "TimelinePostReply":
            subfolder = "timeline_post_replies";
            break;
        case "Invoice":
            subfolder = "invoices";
            break;
        case "InvoiceItem":
            subfolder = "invoice_items";
            break;
        case "StoreItem":
            subfolder = "store_items";
            break;
        case "StoreCart":
            subfolder = "store_carts";
            break;
        case "Session":
            subfolder = "session";
            break;
        case "CartItem":
            subfolder = "cart_items";
            break;
        case "Shipping":
            subfolder = "shipping";
            break;
        case "ShippingOption":
            subfolder = "shipping_options";
            break;
        case "PaypalSellerAccountAuthentication":
            subfolder = "paypal_payment";
            break;
        case "MyVideo":
            subfolder = "videos";
            break;
        case "Profile":
            subfolder = "profile2";
            break;

    }


    return subfolder;
}


function show_x_container(container) {
    container.style.display = "block";
}

function show_x_container2(class_name) {
    $("#" + class_name + "Container").css("display", "block");
}


function hide_x_container(container) {
    container.style.display = "none";
}

function hide_x_container2(class_name) {
    // container.style.display = "none";
    $("#" + class_name + "Container").css("display", "none");
}

function decide_ajax_pre_after_effects(x_obj, json) {
    var class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;


    //
    switch (class_name) {
        case "Invoice":
            do_invoice_pre_after_effects(class_name, crud_type, json);
            break;
        case "StoreItem":
            do_store_item_pre_after_effects(class_name, crud_type, json);
            break;
        case "CartItem":
            do_cart_item_pre_after_effects(class_name, crud_type, json);
            break;
        case "Shipping":
            do_shipping_pre_after_effects(class_name, crud_type, json);
            break;
        case "ShippingOption":
            do_shipping_option_pre_after_effects(class_name, crud_type, json);
            break;
        case "PaypalSellerAccountAuthentication":
            do_paypal_payment_pre_after_effects(class_name, crud_type, json)
            break;
        case "MyVideo":
            // do_shipping_option_pre_after_effects(class_name, crud_type, json);
            do_my_video_pre_after_effects(class_name, crud_type, json, x_obj);
            break;
    }
}


function decide_ajax_after_effects_class_handlers(x_obj, json) {
    var class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;

    //
    switch (class_name) {
        case "FriendshipSuggestion":
            do_friendship_suggestions_after_effects(class_name, crud_type, json);
            break;
        case "FriendshipAcolyte":
            do_friendship_acolytes_after_effects(class_name, crud_type, json);
            break;
        case "FriendshipMuse":
            do_friendship_muses_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Friendship":
            do_friendships_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationFriendship":
            do_notification_friendships_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationMyShopping":
            do_notification_my_shoppings_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationPost":
            do_notification_posts_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationRateableItem":
            do_notification_rateable_items_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "NotificationTimelinePostReply":
            do_notification_timeline_post_replies_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "User":
            do_users_after_effects(class_name, crud_type, json, x_obj);
            // window.alert("TODO:METHOD:do_notification_users_after_effects()");
            break;
        case "Photo":
            do_photos_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "RateableItem":
            do_rateable_item_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "RateableItemUser":
            do_rateable_item_user_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "ChatList":
            do_chat_list_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "ChatMessage":
            do_chat_message_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "AppSetting":
            do_app_setting_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "TimelinePost":
            do_timeline_post_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "TimelinePostSubscription":
            do_timeline_post_subscription_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "TimelinePostReply":
            do_timeline_post_reply_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Invoice":
            do_invoice_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "InvoiceItem":
            do_invoice_item_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "StoreItem":
            do_store_item_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "StoreCart":
            do_store_cart_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Session":
            do_session_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "CartItem":
            do_cart_item_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Shipping":
            do_shipping_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "ShippingOption":
            do_shipping_option_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "PaypalSellerAccountAuthentication":
            do_paypal_payment_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "MyVideo":
            do_my_video_after_effects(class_name, crud_type, json, x_obj);
            break;
        case "Profile":
            do_profile_after_effects(class_name, crud_type, json, x_obj);
            break;
    }
}


function get_key_value_pairs(key_value_pairs, request_type) {
    var arranged_key_value_pairs = "";

    //
    if (request_type == "GET") {
        arranged_key_value_pairs += "?";
    }
    // Create a dynamic hidden csrf_token input.
    else if (request_type == "POST") {
        var input_csrf_token = get_csrf_input();

        // Dynamically append a hidden csrf input to the form "create_post_form".
        document.getElementById("middle_content").appendChild(input_csrf_token);

        //
        arranged_key_value_pairs += "csrf_token=" + document.getElementById("input_csrf_token").value + "&";

        // Right away, remove the hidden csrf input from the form.
        document.getElementById("middle_content").removeChild(input_csrf_token);
    }


    //
    for (var key in key_value_pairs) {
        arranged_key_value_pairs += key + "=" + key_value_pairs[key] + "&";
    }

    return arranged_key_value_pairs;
}


function my_ajax(x_obj) {
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    var request_type = x_obj.request_type;
    var key_value_pairs_arr = x_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);


    //
    var url = "";

    if (caller_class_name == "PaypalSellerAccountAuthentication") {
        url += get_local_url() + "/public/__controller/" + get_subfolder(caller_class_name) + "/" + "PaypalPayment" + "AjaxHandler.php";
    }
    else {
        url += get_local_url() + "/public/__controller/" + get_subfolder(caller_class_name) + "/" + caller_class_name + "AjaxHandler.php";
    }

    var xhr = new XMLHttpRequest();


    // Further set the url for "GET" request.
    if (request_type === "GET") {
        url += key_value_pairs_str;
    }


    //
    xhr.open(request_type, url, true);



    //
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            //
            var response = xhr.responseText.trim();


            // Log before JSON parsing.
            do_browser_ajax_pre_log(x_obj, response, url)


            //
            var json = null;

            try {
                json = JSON.parse(response);
            } catch (e) {
                console.log('ERROR:invalid json');
                json = null;
            }


            //
            do_ajax_result_log(x_obj, json);

            /**/
            decide_ajax_pre_after_effects(x_obj, json);


            // If the response is not successful..
            if (json === null || !json.is_result_ok) {
                // ("RESULT:json.is_result_ok: null/false");
            } else if (json.is_result_ok) {
                // Else if it's successful..
                // ("RESULT:json.is_result_ok: " + json.is_result_ok);


                // "After-Effects" tasks if the AJAX is ok.
                decide_ajax_after_effects_class_handlers(x_obj, json);


            }


            // Show a flash notification of the overall result.
            show_flash_notification(x_obj, json);


            // AJAX Formatted JSON log.
            do_browser_ajax_post_log(x_obj, json);
        }
    };


    // Send.
    if (request_type === "GET") {
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();
    }
    else {
        // You need this for AJAX POST requests.
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(key_value_pairs_str);
    }
}

function do_ajax_result_log(x_obj, json) {
    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }

    // If the response is not successful..
    if (json === null || !json.is_result_ok) {
        console.log("RESULT:json.is_result_ok: null/false");
    } else if (json.is_result_ok) {
        // Else if it's successful..
        console.log("RESULT:json.is_result_ok: " + json.is_result_ok);
    }
}

function should_class_log(x_obj) {

    //
    switch (x_obj.class_name) {
        case "Profile":
            return true;
            break;
    }

    //
    return false;
}


function should_crud_type_log(x_obj) {


    //
    switch (x_obj.crud_type) {
        // case "xxx":
        case "fetch":
            return false;
            break;
        default:
            return true;
            break;
    }
}

function do_browser_ajax_pre_log(x_obj, response, url) {

    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }



    //
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    var request_type = x_obj.request_type;
    var key_value_pairs_arr = x_obj.key_value_pairs;
    var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);



    //
    console.log("REQUEST TYPE: " + request_type);
    console.log("crud_type: " + crud_type);
    console.log("url: " + url);
    console.log("key_value_pairs_str: " + key_value_pairs_str);
    console.log("caller_class_name: " + caller_class_name);



    //
    console.log("*******************************");
    console.log("*** AJAX invoked by class: " + caller_class_name);
    console.log("*** CRUD Type: " + crud_type);

    console.log("*** Log before JSON parsing ***");
    console.log("response: " + response);
}

function do_browser_ajax_post_log(x_obj, json) {

    //
    if (should_class_log(x_obj) && should_crud_type_log(x_obj)) {}
    else { return; }

    //
    var caller_class_name = x_obj.class_name;
    var crud_type = x_obj.crud_type;
    // var request_type = x_obj.request_type;
    // var key_value_pairs_arr = x_obj.key_value_pairs;
    // var key_value_pairs_str = get_key_value_pairs(key_value_pairs_arr, request_type);



    //
    console.log("*******************************");
    console.log("*** Formatted JSON in class: " + caller_class_name);
    console.log("*** CRUD Type: " + crud_type);


    for (var key in json) {
        if (json.hasOwnProperty(key)) {
            var val = json[key];

            // Display in the console.
            console.log(key + " => " + val);


            //
            show_form_errors(key, val, json);
        }
    }
}

function show_form_errors(key, val, json) {
    if (json.form_errors_showable) {
        var error_label = document.getElementById(key);
        if (error_label != null) {
            // Reset the error labels.
            error_label.innerHTML = "error";
            error_label.style.visibility = "hidden";


            // Display error labels.
            if (val != "") {
                error_label.innerHTML = val;
                error_label.style.visibility = "visible";
            }

        }
    }
}