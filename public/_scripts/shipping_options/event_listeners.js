$( document ).ready(function() {
    $(".go-to-shipping-options-btn").click(function () {

        /**/
        disable_all_my_cart_menu_buttons();

        /**/
        if (is_shipping_address_set) {
            read_shipping_options();
        }
        else {
            create_shipping_address();
        }

    });
});

