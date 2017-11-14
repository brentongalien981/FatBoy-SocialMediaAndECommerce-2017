function populate_transaction_summary_container_sections() {
    
    //
    populate_shipping_summary_container();

    //
    populate_cart_items_summary_container();

    //
    populate_transaction_charges_container();
}

function populate_transaction_charges_container() {

    // cart_item_summaries
    var cis = $(".cart-item-summary");
    var sub_total = 0;
    var sales_tax = 0;
    var shipping_fee = 0;
    var total = 0;

    for (i = 0; i < cis.length; i++) {

        // current_item
        var ci = cis[i];


        var current_item_price = $(ci).find(".cart-item-price").html();
        current_item_price = current_item_price.substring(1);
        var current_item_quantity = $(ci).find(".cart-item-quantity").html();

        sub_total += parseFloat(current_item_price) * parseFloat(current_item_quantity);
    }


    //
    sales_tax = sub_total * 0.13;
    shipping_fee = parseFloat($("#shipping-options-list").val()) * 1.13;
    total = sub_total + sales_tax + shipping_fee;


    /**/
    $("#sub-total-summary").html("$" + roundToTwo(sub_total));
    $("#sales-tax-summary").html("$" + roundToTwo(sales_tax));
    $("#shipping-fee-summary").html("$" + roundToTwo(shipping_fee));
    $("#total-summary").html("$" + roundToTwo(total));
}

function populate_shipping_summary_container() {

    $("#shipping-summary-street1").html($("#shipping-street1-input").val());
    $("#shipping-summary-street2").html($("#shipping-street2-input").val());
    $("#shipping-summary-city").html($("#shipping-city-input").val());
    $("#shipping-summary-state").html($("#shipping-state-input").val());
    $("#shipping-summary-zip").html($("#shipping-zip-input").val());
    $("#shipping-summary-country-code").html($("#shipping-country-code-input").val());
    $("#shipping-summary-phone").html($("#shipping-phone-input").val());
}

function populate_cart_items_summary_container() {

    var cart_items = $(".actual-cart-item").clone();

    // Refresh...
    $("#cart-items-summary-container").html("");

    replace_quantity_inputs_by_regular_td_values(cart_items);
}

function replace_quantity_inputs_by_regular_td_values(cart_items) {

    for (i = 0; i < cart_items.length; i++) {

        var cart_item = cart_items[i];
        $(cart_item).removeAttr("id");
        $(cart_item).removeClass("actual-cart-item");
        $(cart_item).addClass("cart-item-summary");

        var current_cart_item_quantity = $(cart_item).find(".cart-item-quantity").val();

        //
        if (current_cart_item_quantity < 1) { continue; }

        var cart_item_detail_value_td = $(cart_item).find(".cart-item-quantity").closest(".cart-item-detail-value");
        $(cart_item_detail_value_td).addClass("cart-item-quantity");
        $(cart_item_detail_value_td).html(current_cart_item_quantity);


        /**/
        $("#cart-items-summary-container").append($(cart_item));
    }
}