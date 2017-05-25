<!--This page is for adding new store item.-->



<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once("../__controller/controller_my_videos.php"); ?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<!--Meat-->
<?php
// Vars
// I do this for the prepopulation of the fields if there's
// an error with the insertion of the item to the db.
$store_item_name = "";
$store_item_price = 0.01;
$store_item_quantity = 1;
$store_item_description = "";
$store_item_photo_address = "";
$store_item_mass = 0.01;
$store_item_length = 0.01;
$store_item_width = 0.01;
$store_item_height = 0.01;



//
if (isset($_GET["is_creation_ok"]) && $_GET["is_creation_ok"] == 1) {
    MyDebugMessenger::add_debug_message("SUCCESS creating that store item shit.");
}

// TODO: For repopulation of the fields's values
// with slightly erronous data. This POST values come from
// the controller validations don't pass.
if (isset($_GET["is_validation_ok"]) && $_GET["is_validation_ok"] == 0) {
    MyDebugMessenger::add_debug_message("GET['is_validation_ok'] is set and there's a validation problem.");

    // TODO: NOW: Set the vasr.
    $store_item_name = $_GET["store_item_name"];
    $store_item_price = $_GET["store_item_price"];
    $store_item_quantity = $_GET["store_item_quantity"];
    $store_item_description = $_GET["store_item_description"];
    $store_item_photo_address = $_GET["store_item_photo_address"];
    $store_item_mass = $_GET["store_item_mass"];
    $store_item_length = $_GET["store_item_length"];
    $store_item_width = $_GET["store_item_width"];
    $store_item_height = $_GET["store_item_height"];
}
?>


<!--<h4>Add a New Store Item<h4>-->
<form id="form_add_item" action="<?php echo LOCAL . '/public/__controller/controller_my_store.php'; ?>" method="post">
    <h5>Store Item's Basic Info</h5> 
    <h6>Name</h6>
    <input type="text" name="store_item_name" id="input_name" value="<?php echo $store_item_name; ?>">

    <?php
    // TODO: Also add the functionality for checking that this is a valid decimal value.
    ?>
    <h6>Price</h6>
    <input type="number" name="store_item_price" min="0.01" step="0.01" value="<?php echo $store_item_price; ?>">

    <h6>Quantity</h6>
    <input type="number" name="store_item_quantity" min="1" value="<?php echo $store_item_quantity; ?>">                

    <?php
    // TODO: Add the php functionality of 2brnl, or automatically adding a
    //       new line whenever a user inputs a new line. So the user won't
    //       have to type a <br> tag herself. It's in Kevin Skoglund's lindt php course.
    ?>
    <h6>Description</h6>
    <textarea name="store_item_description" rows="6" cols="100"><?php echo $store_item_description; ?></textarea><br>             

    <?php
    // TODO: Make a security check for this and all input elements.
    // Maybe use a GENERIC EXPRESSION check??? Is that the right term?
    // But for sure there's a word "expression" on that term..
    ?>
    <h6>Photo Link Address</h6>
    <textarea name="store_item_photo_address" rows="6" cols="100" id="text_area_for_photo_address" 
              onchange="previewPhoto()"
              onkeypress="this.onchange()" 
              onpaste="this.onchange()" 
              oninput="this.onchange()"><?php echo $store_item_photo_address; ?></textarea><br>

    <h6>Photo Preview</h6>
    <img id="photo_preview" alt="store item photo preview..">




    <h5 id="h5_dimensions">Dimensions and Mass When Boxed For Shipping</h5>                


    <h6>Mass in ounces (oz)</h6>
    <input type="number" name="store_item_mass" min="0.01" step="0.01" value="<?php echo $store_item_mass; ?>">
    <?php
//                if (isset($_SESSION["currently_edited_item"])) {
//                    echo $_SESSION['currently_edited_item']['Mass'];
//                }
    ?> 

    <h6>Length in inches (in)</h6>
    <input type="number" name="store_item_length" min="0.01" step="0.01" value="<?php echo $store_item_length; ?>">
    <?php
//                if (isset($_SESSION["currently_edited_item"])) {
//                    echo $_SESSION['currently_edited_item']['Length'];
//                }
    ?>

    <h6>Width in inches (in)</h6>
    <input type="number" name="store_item_width" min="0.01" step="0.01" value="<?php echo $store_item_width; ?>">
    <?php
//                if (isset($_SESSION["currently_edited_item"])) {
//                    echo $_SESSION['currently_edited_item']['Width'];
//                }
    ?>                   

    <h6>Height in inches (in)</h6>
    <input type="number" name="store_item_height" min="0.01" step="0.01" value="<?php echo $store_item_height; ?>">
    <?php
//                if (isset($_SESSION["currently_edited_item"])) {
//                    echo $_SESSION['currently_edited_item']['Height'];
//                }
    ?> 


    <br>
    <input type="submit" name="add_store_item" class="form_button" value="add" />
</form>










<style>
    #form_add_item {
        background-color: red;
        background-color: rgba(50, 50, 50, 0.1);
        margin: 30px;
        /*margin-top: 0;*/
        padding: 20px;
        border-radius: 5px;
        /*margin-bottom: 60px;*/
        box-shadow: 5px 5px 5px rgba(100, 100, 100, 0.80);
    }

    #form_add_item h5 {
        font-size: 15px;
        font-weight: 400;
        margin-bottom: 20px;
    }
    
    #form_add_item h6 {
        font-size: 13px;
        font-weight: 100;
        margin-top: 25px;
        margin-bottom: 5px;
    }



    #form_add_item input {
        width: 90px;
        height: 25px;
        border-radius: 3px;
        padding-left: 10px;
        padding-right: 10px;
    }

    #form_add_item #input_name {
        width: 200px;
    }



    #form_add_item textarea {
        width: 600px;
        border-radius: 3px;
        padding: 10px;
    }
    
    #form_add_item img {
        width: 600px;
        height: 360px;
    }
    
    #h5_dimensions {
        margin-top: 80px;
    }

    #form_add_item .form_button {
        /*display: block;*/
        /*width: 100px;*/
        /*margin-top: 0;*/
        /*padding-left: 0;*/
        /*width: fit-content;*/
        
        /*background-color: red;*/
    }
</style>


<?php
// TODO: REMINDER: Copy the implemented the JS method for the image photo preview..
?>