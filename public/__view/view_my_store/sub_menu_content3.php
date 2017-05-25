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
// This is if the button "update" is clicked.
if (isset($_GET["is_validation_ok"])) {
    if ($_GET["is_validation_ok"] == 1) {
        set_currently_edited_store_item_object(-69);
    } else {
        $item_attribs_array = array();
        $item_attribs_array["store_item_id"] = $_GET["store_item_id"];
        $item_attribs_array["store_item_name"] = $_GET["store_item_name"];
        $item_attribs_array["store_item_price"] = $_GET["store_item_price"];
        $item_attribs_array["store_item_quantity"] = $_GET["store_item_quantity"];
        $item_attribs_array["store_item_description"] = $_GET["store_item_description"];
        $item_attribs_array["store_item_photo_address"] = $_GET["store_item_photo_address"];
        $item_attribs_array["store_item_mass"] = $_GET["store_item_mass"];
        $item_attribs_array["store_item_length"] = $_GET["store_item_length"];
        $item_attribs_array["store_item_width"] = $_GET["store_item_width"];
        $item_attribs_array["store_item_height"] = $_GET["store_item_height"];

        set_currently_edited_store_item_object(-619, $item_attribs_array);
    }
}
// This is if the button "edit" is clicked or
// the tag <select> has been changed.
else {
    // If this page loads by NOT updating the current item
// being edited from the tag <select>, then call this following method.
    $item_id = -69;
    if (isset($_GET["item_id"])) {
        $item_id = $_GET["item_id"];
    }

    set_currently_edited_store_item_object($item_id);
}
?>


<form id="form_edit_item" action="<?php echo LOCAL . '/public/__controller/controller_my_store.php'; ?>" method="post" name="edit_store_item_form">
    <!--<h4>Edit Store Item</h4>-->
    <h5>Store Item's Basic Info</h5> 

    <h6>Which item do you wanna edit?</h6>
    <!--<input type="text" name="store_item_name"/>-->
    <select name="store_item_id" onchange="this.form.submit()">
        <?php show_completely_presented_user_store_names(); ?>
    </select>


    
    <h6>Name</h6>
    <input type="text" name="store_item_name" id="input_name" maxlength="100" value="<?php echo get_currently_edited_store_item_object()->name; ?>">     


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


    <h5 id="h5_dimensions">Dimensions and Mass When Boxed For Shipping</h5>      


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
    <input type="submit" class="form_button" name="update_store_item" value="update">
</form>    

<?php
//// TODO: DEBUG
//echo "PUTA TSHIT";
//echo "<pre>";
//print_r(get_currently_edited_store_item_object());
//echo "</pre>";
?>










<style>
    #form_edit_item {
        background-color: red;
        background-color: rgba(50, 50, 50, 0.1);
        margin: 30px;
        /*margin-top: 0;*/
        padding: 20px;
        border-radius: 5px;
        /*margin-bottom: 60px;*/
        box-shadow: 5px 5px 5px rgba(100, 100, 100, 0.80);
    }
    
    #form_edit_item select {
        height: 25px;
    }

    #form_edit_item h6 {
        font-size: 13px;
        font-weight: 100;
        margin-top: 25px;
        margin-bottom: 5px;
    }



    #form_edit_item input {
        width: 90px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }

    #form_edit_item #input_name {
        width: 200px;
    }

    #form_edit_item textarea {
        width: 600px;
        border-radius: 3px;
        padding: 10px;
    }

    #form_edit_item img {
        width: 600px;
        height: 360px;
    }

    #form_edit_item h5 {
        font-size: 15px;
        font-weight: 400;
        /*margin-top: 40px;*/
        margin-bottom: 30px;
    }

    #h5_dimensions {
        margin-top: 80px;
    }
</style>