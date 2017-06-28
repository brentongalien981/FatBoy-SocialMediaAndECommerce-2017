<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_my_store_items.php"); ?>

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
use App\Publico\Model\MyValidationErrorLogger;


// Functions.
function validate_update_store_item_form() {
// Vars
    global $session;

    $store_item_id = $_POST["store_item_id"];
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
    MyStoreItems::$currently_edited_store_item_object->id = $store_item_id;
    MyStoreItems::$currently_edited_store_item_object->user_id = $store_item_seller_user_id;
    MyStoreItems::$currently_edited_store_item_object->name = $store_item_name;
    MyStoreItems::$currently_edited_store_item_object->price = $store_item_price;
    MyStoreItems::$currently_edited_store_item_object->description = $store_item_description;
    MyStoreItems::$currently_edited_store_item_object->photo_address = $store_item_photo_address;
    MyStoreItems::$currently_edited_store_item_object->quantity = $store_item_quantity;
    MyStoreItems::$currently_edited_store_item_object->mass = $store_item_mass;
    MyStoreItems::$currently_edited_store_item_object->length = $store_item_length;
    MyStoreItems::$currently_edited_store_item_object->width = $store_item_width;
    MyStoreItems::$currently_edited_store_item_object->height = $store_item_height;


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
        MyDebugMessenger::add_debug_message("SUCCESS update store item validation.");

        // 
        return true;
    } else {
        MyDebugMessenger::add_debug_message("FAIL update store item validation.");

        $validation_errors = MyValidationErrorLogger::get_log_array();

        foreach ($validation_errors as $error) {
            MyDebugMessenger::add_debug_message($error);
        }


        // 
        return false;
    }
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

function update_store_item_record_to_db() {
    $is_update_ok = MyStoreItems::$currently_edited_store_item_object->update();
    return $is_update_ok;
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

function show_completely_presented_user_store_names() {
    global $database;
    global $session;

    $query = "SELECT * FROM MyStoreItems ";
    $query .= "WHERE user_id = {$session->actual_user_id} ";
    $query .= "ORDER BY name";


    $result_set = MyStoreItems::read_by_query($query);


    while ($row = $database->fetch_array($result_set)) {
//        // Just initialize the global var if this page request
//        // didn't come from a post request. So then there's an
//        // initially selected store item on the list.
//        if (!isset($_SESSION["currently_edited_item"])) {
//            $_SESSION["currently_edited_item"] = $row;
//        }

        echo "<option value='{$row['id']}'";

        // Just keep the selected item selected on the list
        // even when the page reloads.
        if ($row['id'] == get_currently_edited_store_item_object()->id) {
            echo " selected";
        }

        echo ">";
        echo "{$row['name']}";
        echo "</option>";
    }
}

//function get_completely_presented_user_videos_array() {
//    global $session;
//
//    //
//    $query = "SELECT * FROM MyVideos ";
//    $query .= "WHERE user_id = {$session->currently_viewed_user_id} ";
//    $query .= "ORDER BY id DESC";
//
//
//    //
//    $user_videos_records_result_set = MyVideo::read_by_query($query);
//
//
//    //
//    $completely_presented_user_videos_array = array();
//
//
//    //
//    require_once("../__model/my_database.php");
//    global $database;
//
//    while ($row = $database->fetch_array($user_videos_records_result_set)) {
//        //
//        $completely_presented_user_video = "<tr>";
//        $completely_presented_user_video .= "<td>";
//        $completely_presented_user_video .= "<div>";
//        $completely_presented_user_video .= "<h4>{$row['title']}</h4>";
//        $completely_presented_user_video .= "{$row['embed_code']}<br>";
//        $completely_presented_user_video .= "<a>lupetness</a>";
//        $completely_presented_user_video .= "</div>";
//        $completely_presented_user_video .= "</td>";
//        $completely_presented_user_video .= "</tr>";
//
//        //
//        array_push($completely_presented_user_videos_array, $completely_presented_user_video);
//    }
//
//
//    // 
//    return $completely_presented_user_videos_array;
//}

function get_currently_edited_store_item_object() {
    if (isset(MyStoreItems::$currently_edited_store_item_object)) {
        return MyStoreItems::$currently_edited_store_item_object;
    } else {
        die("MyStoreItems::currently_edited_store_item_object IS NOT SET!");
    }
}

function set_currently_edited_store_item_object($item_id = -69, $item_attribs_array = null) {
    // This is if the update button has been clicked.
    if (isset($item_attribs_array)) {
        MyStoreItems::$currently_edited_store_item_object = new MyStoreItems();

        //
        MyStoreItems::$currently_edited_store_item_object->id = $item_attribs_array["store_item_id"];
        MyStoreItems::$currently_edited_store_item_object->name = $item_attribs_array["store_item_name"];
        MyStoreItems::$currently_edited_store_item_object->price = $item_attribs_array["store_item_price"];
        MyStoreItems::$currently_edited_store_item_object->description = $item_attribs_array["store_item_description"];
        MyStoreItems::$currently_edited_store_item_object->photo_address = $item_attribs_array["store_item_photo_address"];
        MyStoreItems::$currently_edited_store_item_object->quantity = $item_attribs_array["store_item_quantity"];
        MyStoreItems::$currently_edited_store_item_object->mass = $item_attribs_array["store_item_mass"];
        MyStoreItems::$currently_edited_store_item_object->length = $item_attribs_array["store_item_length"];
        MyStoreItems::$currently_edited_store_item_object->width = $item_attribs_array["store_item_width"];
        MyStoreItems::$currently_edited_store_item_object->height = $item_attribs_array["store_item_height"];
    }
    // This is if the button "edit" was clicked or
    // tag <select> has been changed.
    else {
        // If the currently edite item object isn't set,
        // I don't have to do anything.
//    if (!isset(MyStoreItems::$currently_edited_store_item_object)) {
        if ($item_id == -69) {
            //
            global $session;
            $query = "SELECT * FROM MyStoreItems WHERE user_id = {$session->actual_user_id} LIMIT 1";

            //
            $store_item_record = MyStoreItems::read_by_query($query);

            //
            $temp_obj = MyStoreItems::get_instantiated_object_by_record($store_item_record);

            //
            MyStoreItems::$currently_edited_store_item_object = $temp_obj;
        } else {
            //
            $store_item_record = MyStoreItems::read_by_id($item_id);

            //
            $temp_obj = MyStoreItems::get_instantiated_object_by_record($store_item_record);

            //
            MyStoreItems::$currently_edited_store_item_object = $temp_obj;
        }
    }
}

function show_user_store_items() {
    //
    global $session;
    $query = "SELECT * FROM MyStoreItems ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";


    //
    $store_items_record_result_set = MyStoreItems::read_by_query($query);


//    echo "<h4>MyStore</h4><br>";
//    echo "<div id='container_for_table_store_items'>";
    echo "<table id='table_store_items'>";

    //
    global $database;
    while ($row = $database->fetch_array($store_items_record_result_set)) {
        echo "<tr>";
        echo "<td>";
        echo "<div class='section_item'>";
        // Name
        echo "<h4>{$row['name']}: {$row['quantity']} item";

        // Singular.. 
        if ($row['quantity'] == 1) {
            echo " remaining</h4>";
        } else {
            echo "s remaining</h4>";
        }


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
        if ((!$session->is_viewing_own_account()) && ($row["quantity"] > 0)) {
            echo "<form action='" . LOCAL . "/public/__controller/controller_my_store.php' method='post'>";
            echo "<input type='hidden' name='item_id' value='{$row['id']}'>";
            echo "<input type='submit' name='add_item_to_cart' class='form_button' value='add to my cart'>";
            echo "</form>";
        }
        // This means the actual user is viewing her own account.
        // So let her see the edit button.
        else if ($session->is_viewing_own_account()) {

            echo "<form action='" . LOCAL . "/public/__controller/controller_my_store.php' method='post'>";
            echo "<input type='submit' class='form_button' value='edit' name='edit_store_item'>";
            echo "<input type='hidden' value='{$row['id']}' name='store_item_id'>";
            echo "</form>";
        }

        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
//    echo "</div>";
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
}


if (isset($_POST["update_store_item"])) {
    // TODO: LOG
    MyDebugMessenger::add_debug_message("BUTTON 'update_store_item' clicked.");

    //
    MyStoreItems::$currently_edited_store_item_object = new MyStoreItems();

    //
    $is_validation_ok = validate_update_store_item_form();
       




    //
    if ($is_validation_ok) {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("SUCCESS update validation.");           
        
        //
        $is_update_ok = update_store_item_record_to_db($temporary_new_store_item);

        //
        if ($is_update_ok) {
            // TODO: LOG
            MyDebugMessenger::add_debug_message("UPDATE is ok.");

            //
            redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=3&is_validation_ok=1&is_update_ok=1");
        } else {
            // TODO: LOG
            MyDebugMessenger::add_debug_message("UPDATE is not ok.");

            //
            redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=3&is_validation_ok=1&is_update_ok=0");
        }
    } 
    else {
        // TODO: LOG
        MyDebugMessenger::add_debug_message("FAIL update validation.");       
        
        // GET params for the currently edited item attributes.
        // MyStoreItems::$currently_edited_store_item_object
        $params_in_str = "is_validation_ok=0&";
        $params_in_str .= "store_item_id=" . urlencode(MyStoreItems::$currently_edited_store_item_object->id) . "&";
        $params_in_str .= "store_item_name=" . urlencode(MyStoreItems::$currently_edited_store_item_object->name) . "&";
        $params_in_str .= "store_item_price=" . urlencode(MyStoreItems::$currently_edited_store_item_object->price) . "&";
        $params_in_str .= "store_item_description=" . urlencode(MyStoreItems::$currently_edited_store_item_object->description) . "&";
        $params_in_str .= "store_item_photo_address=" . urlencode(MyStoreItems::$currently_edited_store_item_object->photo_address) . "&";
        $params_in_str .= "store_item_quantity=" . urlencode(MyStoreItems::$currently_edited_store_item_object->quantity) . "&";
        $params_in_str .= "store_item_mass=" . urlencode(MyStoreItems::$currently_edited_store_item_object->mass) . "&";
        $params_in_str .= "store_item_length=" . urlencode(MyStoreItems::$currently_edited_store_item_object->length) . "&";
        $params_in_str .= "store_item_width=" . urlencode(MyStoreItems::$currently_edited_store_item_object->width) . "&";
        $params_in_str .= "store_item_height=" . urlencode(MyStoreItems::$currently_edited_store_item_object->height);

        
        redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=3&" . "{$params_in_str}");
    }
}


// This is if the item being updated is changed
// based on the tag <select>.
if (isset($_POST["store_item_id"]) || // Coming from the tag <select>...
        isset($_POST["edit_store_item"])) { // Coming from the button "edit"...
    $item_id = isset($_POST["store_item_id"]) ? $_POST["store_item_id"] : $_POST["edit_store_item"];


    //
    redirect_to(LOCAL . "/public/__view/view_my_store/index.php?store_content_page=3&item_id={$item_id}");
}



if (isset($_POST["add_item_to_cart"])) {
    require_once(PUBLIC_PATH . "/__controller/controller_store_cart.php");
    
    add_item_to_cart($_POST["item_id"]);
}
?>