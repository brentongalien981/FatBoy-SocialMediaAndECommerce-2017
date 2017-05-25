<!--This page is for viewing my store.-->



<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<!--Meat-->
<?php
//
require_once(PUBLIC_PATH . "/__controller/controller_my_store.php");

//
show_user_store_items();
?>










<style>
    /*    #container_for_table_store_items {
            padding: 30px;
            padding-top: 50px;
            background-color: yellow;
        }*/

    div.section_item {
        color: black;
        /*background-color: beige;*/
        background-color: rgba(50, 50, 50, 0.1);
        margin: 30px;
        padding: 20px;
        border-radius: 5px;
        /*margin-bottom: 60px;*/
        box-shadow: 5px 5px 5px rgba(100, 100, 100, 0.80);
    }

    #table_store_items h4 {
        font-size: 14px;
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    #table_store_items h5 {
        font-size: 10px;
        font-weight: 100;
        margin-bottom: 20px;
    }

    #table_store_items img {
        width: 600px;
        height: 360px;
    }

    #table_store_items p {
        font-size: 12px;
        font-weight: 100;
        margin-bottom: 20px;
        width: 600px;
        /*margin-right: 10px;*/
        /*background-color: yellow;*/
    }

    .form_button {
        margin-top: 0;
    }
</style>