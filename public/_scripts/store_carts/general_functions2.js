function set_my_cart_current_step_content(current_step) {

    if (!is_my_cart_current_step_pre_condition_met(current_step)) { return; }

    set_my_cart_current_step_navigation_btn(current_step);
    set_my_cart_current_step_main_content(current_step);
    set_my_cart_current_step_incremental_btn(current_step);
}

function set_my_cart_current_step_navigation_btn(current_step) {

    /**/
    $(".store-cart-steps-btn").removeClass("my-cart-current-step-navigation-btn");

    /**/
    switch (current_step) {
        case CART_SELECTION:
            $("#go-to-cart-selection-nav-btn").addClass("my-cart-current-step-navigation-btn");
            break;
        case SHIPPING_ADDRESS_FILLING:
            $("#continue-to-shipping-address-nav-btn").addClass("my-cart-current-step-navigation-btn");
            break;
        case SHIPPING_OPTION_SELECTION:
            $("#go-to-shipping-options-nav-btn").addClass("my-cart-current-step-navigation-btn");
            break;
        case TRANSACTION_SUMMARY:
            $("#go-to-transaction-summary-nav-btn").addClass("my-cart-current-step-navigation-btn");
            break;
        case PAYING_TRANSACTION:
            break;


    }
}

function set_my_cart_current_step_main_content(current_step) {

    /**/
    hide_cart_menu_containers();

    /**/
    switch (current_step) {
        case CART_SELECTION:
            $("#cart-list-container").css("display", "block");
            $("#cart-items-container").css("display", "block");
            break;
        case SHIPPING_ADDRESS_FILLING:
            $("#shipping-details-container").css("display", "block");
            break;
        case SHIPPING_OPTION_SELECTION:
            $("#shipping-options-container").css("display", "none");
            break;
        case TRANSACTION_SUMMARY:
            $("#main_content").append($("#transaction-summary-container"));
            $("#main_content").append($("#my-cart-step-incremental-btn-container"));
            $("#transaction-summary-container").css("display", "block");
            break;
        case PAYING_TRANSACTION:
            $("#payment-pre-status-container").css("display", "block");
            break;

    }
}

function is_my_cart_current_step_pre_condition_met(current_step) {

    switch (current_step) {
        case CART_SELECTION:
            return true;
            break;
        case SHIPPING_ADDRESS_FILLING:

            if ((is_cart_item_updating) ||
                (!can_fill_shipping_address) ||
                (!does_cart_contain_item())) {

                return false;
            }
            else {
                return true;
            }
            break;
        case SHIPPING_OPTION_SELECTION:
            return true;
            break;
        case TRANSACTION_SUMMARY:

            if ((is_cart_item_updating) ||
                (!can_fill_shipping_address) ||
                (!does_cart_contain_item()) ||
                (!is_shipping_address_really_set())) {

                return false;
            }
            else {
                return true;
            }
            break;
        case PAYING_TRANSACTION:

            //
            if (!get_are_cart_items_set()) {
                window.alert("Sorry, but your shopping cart is not set..");
                return false;
            }

            //
            if (!get_is_shipping_options_set()) {
                window.alert("Sorry, but your shipping option is not set..");
                return false;
            }

            return true;
            break;

    }
}

function set_my_cart_current_step_incremental_btn(current_step) {

    /**/
    $(".my-cart-step-incremental-btn").removeClass("my-cart-current-step-incremental-btn");

    /**/
    switch (current_step) {
        case CART_SELECTION:
            $("#continue-to-shipping-address-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            break;
        case SHIPPING_ADDRESS_FILLING:
            $("#go-to-cart-selection-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            $("#go-to-shipping-options-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            // $("#shit").addClass("my-cart-current-step-incremental-btn");
            break;
        case SHIPPING_OPTION_SELECTION:
            $("#go-back-to-shipping-address-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            $("#go-to-transaction-summary-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            break;
        case TRANSACTION_SUMMARY:
            $("#go-back-to-shipping-options-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            $("#pay-transaction-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            break;
        case PAYING_TRANSACTION:
            $("#go-back-to-transaction-summary-incremental-btn").addClass("my-cart-current-step-incremental-btn");
            $("#cancel-payment-temp-btn").addClass("my-cart-current-step-incremental-btn");
            break;

    }
}
