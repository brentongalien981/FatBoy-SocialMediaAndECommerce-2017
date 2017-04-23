<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_store_cart.php"); ?>

<?php require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>





<?php
// Protected page.
if (!$session->is_logged_in()) {
    redirect_to("../index.php");
}
?>





<?php
// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// Functions.
function add_item_to_cart($item_id) {
    // Make sure the actual user is not buying from her own store.
    global $session;
    if ($session->is_viewing_own_account()) {
        redirect_to(LOCAL . "/public/__view/view_store_cart.php");
    }
    
    
    //
    $seller_user_id = $session->currently_viewed_user_id;
    $buyer_user_id = $session->actual_user_id;
    
    //
    $does_cart_exist = does_cart_exist($seller_user_id, $buyer_user_id);
    
    
    
    
    
    if ($does_cart_exist) {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("<br>DEBUG: CART EXISTS<br>");
    }
    else {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("<br>DEBUG: CART DOES NOT EXIST<br>");
        
        
        // Create a new cart.
        create_new_cart($seller_user_id, $buyer_user_id);
    }
    
    

    // Select a current cart based on the seller's user id of that item you're adding.
    set_current_session_cart($seller_user_id, $buyer_user_id);
    
    
    
    // Now there's a working session cart.    
    // Check if the to-be-inserted item to cart already exists in that cart.
    $is_item_already_on_cart = is_item_already_on_cart($session->get_cart()->cart_id, $item_id);
    
    // TODO: DEBUG
    // This might not work because of the var "$is_item_al.....".
    MyDebugMessenger::add_debug_message("<br>is_item_already_on_cart: {$is_item_already_on_cart}<br>");
    
    
    
    //
    if ($is_item_already_on_cart) {
        // TODO: DEBUG
        MyDebugMessenger::add_debug_message("<br>Item was already in cart.<br>");
        
    }
    else {
        //
        MyDebugMessenger::add_debug_message("<br>Adding item to cart.<br>");
        
        
        //
        $is_creation_ok = add_item_to_cart_bruh($session->get_cart()->cart_id, $item_id);
        
        //
        MyDebugMessenger::add_debug_message("<br>Adding item to cart message: {$is_creation_ok}.<br>");
       
    }
    
    
    //
    redirect_to(LOCAL . "/public/__view/view_my_store");
}






// Helper
function is_item_already_on_cart($cart_id, $item_id) {
    // Call to controller_cart_item.php.
    return is_item_already_on_cart_bruh($cart_id, $item_id);
}

function set_current_session_cart($seller_user_id, $buyer_user_id) {
    $code_incomplete_cart = 0;
    
    $query = "SELECT * FROM StoreCart WHERE seller_user_id = {$seller_user_id} AND buyer_user_id = {$buyer_user_id} AND is_complete = {$code_incomplete_cart}";
    
    $new_cart_obj = StoreCart::read_by_query_and_instantiate($query)[0];
    
    global $session;
    $session->set_cart($new_cart_obj);
}

function create_new_cart($seller_user_id, $buyer_user_id) {
    $code_incomplete_cart = 0;  
    
    $current_cart = new StoreCart();
    $current_cart->cart_id = null;
    $current_cart->seller_user_id = $seller_user_id;
    $current_cart->buyer_user_id = $buyer_user_id;
    $current_cart->is_complete = $code_incomplete_cart;
    
    $is_creation_ok = $current_cart->create_with_bool();
    
    if ($is_creation_ok) {
        // TODO: DEBUG
        echo "<br>SUCCESS Cart creation.<br>";
    }
    else {
        // TODO: DEBUG
        echo "<br>FAIL Cart creation.<br>";
    }

}

function does_cart_exist($seller_user_id, $buyer_user_id) {
    //
    $code_incomplete_cart = 0;    
    
    //
    $query = "SELECT * FROM StoreCart WHERE seller_user_id = {$seller_user_id} AND buyer_user_id = {$buyer_user_id} AND is_complete = {$code_incomplete_cart}";
    
    //
    $result_set = StoreCart::read_by_query($query);
    
    //
    global $database;
    $num_of_rows =  $database->get_num_rows_of_result_set($result_set);
    
    if ($num_of_rows > 0) {
        return true;
    }
    else {
        return false;
    }
}

?>




<!--Meat-->
<?php
?>