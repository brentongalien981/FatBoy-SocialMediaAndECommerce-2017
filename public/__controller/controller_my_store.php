<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_my_store_items.php"); ?>

<?php defined("LOCAL") ? null : define("http://localhost/myPersonalProjects/FatBoy"); ?>





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
// TODO: NOT USED.
function show_add_new_video_form() {
    $form = "<h4>Add a New Video<h4>";
    $form .= "<form action='../__controller/controller_my_videos.php' method='post'>";
    $form .= "<h6>Video Title</h6>";
    $form .= "<input type='text' name='video_title'/>";
    $form .= "<h6>Embedded Code</h6>";
    $form .= "<textarea name='embedded_video_code' rows='6' cols='100'></textarea><br>";
    $form .= "<input type='submit' name='add_video' value='add video' />";
    $form .= "</form><br><br>";

    echo $form;
}

function validate_add_new_store_item_form($temporary_new_store_item) {
    // Vars
    global $session;
    $store_item_seller_user_id = $session->actual_user_id;
    $store_item_name = $_POST["store_item_name"];
    $store_item_price = $_POST["store_item_price"];
    $store_item_quantity = $_POST["store_item_quantity"];
    $store_item_description = $_POST["store_item_description"];
    $store_item_photo_address = $_POST["store_item_photo_address"];
    $store_item_mass = $_POST["store_item_mass"];
    $store_item_length = $_POST["store_item_length"];
    $store_item_width = $_POST["store_item_width"];
    $store_item_height = $_POST["store_item_height"];


    //
    $temporary_new_store_item->id = null;
    $temporary_new_store_item->user_id = $store_item_seller_user_id;
    $temporary_new_store_item->name = $store_item_name;
    $temporary_new_store_item->price = $store_item_price;
    $temporary_new_store_item->description = $store_item_description;
    $temporary_new_store_item->photo_address = $store_item_photo_address;
    $temporary_new_store_item->quantity = $store_item_quantity;
    $temporary_new_store_item->mass = $store_item_mass;
    $temporary_new_store_item->length = $store_item_length;
    $temporary_new_store_item->width = $store_item_width;
    $temporary_new_store_item->height = $store_item_height;


    // Fuckin need this everytime you validate.
    MyValidationErrorLogger::initialize();


    // Validations
    $required_fields = array("store_item_name", "store_item_price", "store_item_quantity", "store_item_description", "store_item_photo_address", "store_item_mass", "store_item_length", "store_item_width", "store_item_height");
    validate_presences($required_fields);


    $fields_with_max_lengths = array("store_item_name" => 100, "store_item_description" => 3000, "store_item_photo_address" => 1000);
    validate_max_lengths($fields_with_max_lengths);


    // 
    if (MyValidationErrorLogger::is_empty()) {
        // Proceed to the next validation step.
        MyDebugMessenger::add_debug_message("SUCCESS new store item validation.");

        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL new store item validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }


        // 
        return false;
    }
}

function add_new_store_item_record_to_db($new_store_item) {
    //
    //
    $new_store_item_creation_result_flag = $new_store_item->create_with_bool();

    // TODO: DEBUG
    echo "<pre>";
    print_r($new_store_item_creation_result_flag);
    echo "</pre>";



    if ($new_store_item_creation_result_flag) {
        MyDebugMessenger::add_debug_message("SUCCESS creation and insertion of store item record.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL creation and insertion of store item record.");
    }
}

// TODO: NOT USED.
function get_completely_presented_user_videos_array() {
    global $session;

    //
    $query = "SELECT * FROM MyVideos ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
    $query .= "ORDER BY id DESC";


    //
    $user_videos_records_result_set = MyVideo::read_by_query($query);


    //
    $completely_presented_user_videos_array = array();


    //
    require_once("../__model/my_database.php");
    global $database;

    while ($row = $database->fetch_array($user_videos_records_result_set)) {
        //
        $completely_presented_user_video = "<tr>";
        $completely_presented_user_video .= "<td>";
        $completely_presented_user_video .= "<div>";
        $completely_presented_user_video .= "<h4>{$row['title']}</h4>";
        $completely_presented_user_video .= "{$row['embed_code']}<br>";
        $completely_presented_user_video .= "<a>lupetness</a>";
        $completely_presented_user_video .= "</div>";
        $completely_presented_user_video .= "</td>";
        $completely_presented_user_video .= "</tr>";

        //
        array_push($completely_presented_user_videos_array, $completely_presented_user_video);
    }


    // 
    return $completely_presented_user_videos_array;
}

function show_user_store_items() {
    //
    global $session;
    $query = "SELECT * FROM MyStoreItems ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";


    //
    $store_items_record_result_set = MyStoreItems::read_by_query($query);


    echo "<h4>MyStore</h4><br>";
    echo "<table>";
    
    //
    global $database;
    while ($row = $database->fetch_array($store_items_record_result_set)) {
        echo "<tr>";
        echo "<td>";
        echo "<div>";
        // Name
        echo "<h4>{$row['name']}: {$row['quantity']} item";
        
        // Singular.. 
        if ($row['quantity'] == 1) {
            echo " remaining</h4>";
        }
        
        echo "s remaining</h4>";

        
        // Price
        echo "<h5>\${$row['price']}</h5>";
        // Description
        echo "<p>{$row['description']}</p>";
        // Photo
        echo "<img src='{$row['photo_address']}'><br><br>";

        // If the actual user is viewing her own store,
        // then don't let her see this button so she won't
        // be able to buy her own stuffs.
        // And also, check if the stock quantity is more than zero.
        // If it is zero, then don't show the button "add to cart".
        // TODO: CRUCIAL: This should be a form.
        if ((!$session->is_viewing_own_account()) && ($row["quantity"] > 0)) {
//            echo "<button><a href='my_cart_item_creation.php?item_id={$row['Id']}&" .
//            "seller_id={$row['UserId']}&" .
//            "item_name={$row['Name']}&" .
//            "item_price={$row['Price']}&" .
//            "item_quantity=1&" .
//            "max_quantity={$row['Quantity']}'>Add to my cart" .
//            "</a>" .
//            "</button>";
            echo "<form>";
            echo "<input type='submit' value='add to my cart'>";
            echo "</form>";
        }
        // This means the actual user is viewing her own account.
        // So let her see the edit button.
        else if ($session->is_viewing_own_account()) {

            // TODO: Crucial.
            echo "<form action='my_store_item_update.php' method='post'>";
            echo "<input type='submit' value='edit' name='editStoreItem'>";
            //hiddenStoreItemId
            echo "<input type='hidden' value='{$row['id']}' name='hiddenStoreItemId'>";
            echo "</form>";
        }

        echo "</div><br><br><br><br><hr>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table><br><br><br>";
}
?>




<!--Meat-->
<?php
if (isset($_POST["add_store_item"])) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON 'add_store_item' clicked.");


    // Prepare a temporary store item object.
    // You might create it if validation is ok,
    // or you might re-edit it if validation fails.
    $temporary_new_store_item = new MyStoreItems();

//    MyStoreItems::set_temporary_object($temporary_new_store_item);
    //
    $is_validation_ok = validate_add_new_store_item_form($temporary_new_store_item);

    //
    if ($is_validation_ok) {
        //
        add_new_store_item_record_to_db($temporary_new_store_item);


        //
        redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=2&is_creation_ok=1");
    } else {
        // GET params for $temporary_new_store_item attributes.
        $params_in_str = "is_validation_ok=0&";
        $params_in_str .= "store_item_name={$temporary_new_store_item->name}&";
        $params_in_str .= "store_item_price={$temporary_new_store_item->price}&";
        $params_in_str .= "store_item_description={$temporary_new_store_item->description}&";
        $params_in_str .= "store_item_photo_address={$temporary_new_store_item->photo_address}&";
        $params_in_str .= "store_item_quantity={$temporary_new_store_item->quantity}&";
        $params_in_str .= "store_item_mass={$temporary_new_store_item->mass}&";
        $params_in_str .= "store_item_length={$temporary_new_store_item->length}&";
        $params_in_str .= "store_item_width={$temporary_new_store_item->width}&";
        $params_in_str .= "store_item_height={$temporary_new_store_item->height}";


        //
        redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=2&" . "{$params_in_str}");
    }


    //
//    redirect_to(LOCAL . "/public/__view/view_my_store");
}
?>