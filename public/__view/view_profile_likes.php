<?php require_once(PUBLIC_PATH . "/__controller/controller_like.php"); ?>

<div class="section">


    <!--Contact Info Header table.-->
    <table>
        <tbody>
            <tr>
                <td><h4>Contact Info</h4></td>

                <td><?php show_add_a_like_button(); ?></td>
            </tr>
        </tbody>
    </table>

    <hr>    


    <?php
//// Form for letting the actual user add her likes.
//// If the user is signed-in and actual user is the one viewing her own account,
//// then let the actual user add her likes.
//    if ($session->is_viewing_own_account()) {}
    ?>

    <form id='add_like_form' action='<?php echo LOCAL . "/public/__controller/controller_like.php"; ?>' method='post'>
        <h4>A new like</h4>
        <input class='form_text_input' name='a_new_like' value='' type='text'>
        <input id='add_the_like_button' class='form_button' type='button' name='add_like' value='add like'>
    </form>    








    <h4>My Likes</h4>

    <!--Display of all user's likes.--> 
    <?php
    require_once(PUBLIC_PATH . "/__controller/controller_like.php");


//
    $completely_presented_user_likes_array = get_completely_presented_user_likes_array();

//
    echo "<table id='like_table'>";

//
    foreach ($completely_presented_user_likes_array as $completely_presented_user_like) {
        echo "<tr>";
        echo $completely_presented_user_like;
        echo "</tr>";
    }

//
    echo "</table>";
    ?>    
</div>





<style>
    #add_like_form {
        display: none;
        width: 300px;
        margin-top: 15px;
        margin-bottom: 15px;
        padding-bottom: 0;
        border-radius: 5px;
        background-color: rgb(240, 252, 255);
        box-shadow: 5px 5px 5px rgb(150, 150, 150);
    }
    
    button.form_button {
        margin: 0;
    }
</style>