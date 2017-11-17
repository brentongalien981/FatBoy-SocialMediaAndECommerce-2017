$( document ).ready(function() {
    $(".go-to-shipping-options-btn").click(function () {

        if (!get_are_cart_items_set()) {
            window.alert("Sorry but you have to select which cart you wann checkout with first..");
            return;
        }


        /**/
        if (is_shipping_address_set) {

            // Re-show the previously set shipping-options-container.
            if (get_is_shipping_options_set()) {

                set_my_cart_current_step_content(SHIPPING_OPTION_SELECTION);


                $("#shipping-options-container").css("display", "block");
            }
            else {
                read_shipping_options();
            }
        }
        else {
            create_shipping_address();
        }

    });
});

