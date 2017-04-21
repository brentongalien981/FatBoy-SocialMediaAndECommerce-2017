<!--This page is for editing store item.-->



<!--Imports-->
<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_my_store.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>







<?php
// Make sure the actual user is logged-in. and 
// viewing her own account.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<!--Meat-->
<?php
// If this page loads by NOT updating the current item
// being edited from the tag <select>, then call this following method.
$item_id = -69;
if (isset($_GET["item_id"])) {
    $item_id = $_GET["item_id"];
}

set_currently_edited_store_item_object($item_id);
?>


<br><br>
<form action="<?php echo LOCAL . '/public/__controller/controller_my_store.php'; ?>" method="post" name="edit_store_item_form">
    <h4>Edit Store Item</h4>

    <h6>Which item do you wanna edit?</h6>
    <!--<input type="text" name="store_item_name"/>-->
    <select name="store_item_id" onchange="this.form.submit()">
        <?php show_completely_presented_user_store_names(); ?>
    </select>


    <h6>Name</h6>
    <input type="text" name="store_item_name" maxlength="100" value="<?php echo get_currently_edited_store_item_object()->name; ?>">     


    <h6>Price in USD</h6>
    <input type="number" name="store_item_price" min="0.01" step="0.01" value="<?php echo get_currently_edited_store_item_object()->price; ?>">     


    <h6>Quantity</h6>
    <input type="number" name="store_item_quantity" min="0" value="<?php echo get_currently_edited_store_item_object()->quantity; ?>">     


    <h6>Photo Link Address</h6>
    <textarea name="store_item_photo_address" rows="6" cols="100"
              id="text_area_for_photo_address" 
              onchange="preview_photo()"
              onkeypress="this.onchange()" 
              onpaste="this.onchange()" 
              oninput="this.onchange()"><?php echo get_currently_edited_store_item_object()->photo_address; ?>
    </textarea><br>  


    <h6>Photo Preview</h6>
    <?php
    echo "<img id='photo_preview' ";

    echo "src='" . get_currently_edited_store_item_object()->photo_address . "' ";

    echo "alt='Store Item Photo'><br>";
    ?>     


    <br><br>



    <h5>Dimensions and Mass When Boxed For Shipping</h5>      


    <h6>Mass in ounces (oz)</h6>
    <input type="number" name="store_item_mass" min="0.01" step="0.01" value="<?php echo get_currently_edited_store_item_object()->mass; ?>">               


    <h6>Length in inches (in)</h6>
    <input type="number" name="store_item_length" min="0.01" step="0.01" value="<?php echo get_currently_edited_store_item_object()->length; ?>">               


    <h6>Width in inches (in)</h6>
    <input type="number" name="store_item_width" min="0.01" step="0.01" value="<?php echo get_currently_edited_store_item_object()->width; ?>">                               

    <h6>Height in inches (in)</h6>
    <input type="number" name="store_item_height" min="0.01" step="0.01" value="<?php echo get_currently_edited_store_item_object()->height; ?>">                               


    <?php
// TODO: Add the php functionality of 2brnl, or automatically adding a
//       new line whenever a user inputs a new line. So the user won't
//       have to type a <br> tag herself. It's in Kevin Skoglund's lindt php course.
    ?>
    <h6>Description</h6>
    <textarea name="store_item_description" rows="6" cols="100"><?php echo get_currently_edited_store_item_object()->description; ?></textarea><br><br>                


    <br>            
    <input type="submit" name="update_store_item" value="update">
</form>    

<?php
//// TODO: DEBUG
//echo "PUTA TSHIT";
//echo "<pre>";
//print_r(get_currently_edited_store_item_object());
//echo "</pre>";
?>