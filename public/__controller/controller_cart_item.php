<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_cart_item.php"); ?>

<?php // require_once(PUBLIC_PATH . "/__controller/controller_cart_item.php"); ?>

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






// Helper
function add_item_to_cart_bruh($cart_id, $item_id) {
    $new_cart_item = new CartItem();
    $new_cart_item->id = null;
    $new_cart_item->cart_id = $cart_id;
    $new_cart_item->item_id = $item_id;
    $new_cart_item->quantity = 1;
    
    $is_creation_ok = $new_cart_item->create_with_bool();
    
    return $is_creation_ok;
}

function is_item_already_on_cart_bruh($cart_id, $item_id) {
    //
    $query = "SELECT * FROM CartItems WHERE (cart_id = {$cart_id} AND item_id = {$item_id})";
    
    //
    $result_set = CartItem::read_by_query($query);
    
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