<div id="divStatus">

    <!--    If logged-in, display a user-home-menu that let's the user go back-->
    <!--    to her home page when clicked. Else, just don't respond to it's click event. -->
    <?php if ($session->is_logged_in()) { ?>

        <a id="link_home" href="<?= LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1" ?>">
            <?php show_user_home_icon($session->actual_user_id, "header_icon", "user_home") ?>
        </a>

    <?php } else { ?>

        <a id="link_home" href="#">
            <?php show_default_user_home_icon("header_icon", "user_home") ?>
        </a>

    <?php } ?>
</div>


<?php require_once(PUBLIC_PATH . "/_layouts/banner_user_home_menu_popup.php"); ?>


<!--Functions-->
<?php
/**
 * @param int $user_id
 * @return picture src / null
 */
function b_get_profile_pic_src($user_id = 0)
{
    global $session;

    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$user_id} LIMIT 1";

    $record_result = Profile::read_by_query($query);

    global $database;

    // Default pic_url.
    $src = null;


    $num_of_results = $database->get_num_rows_of_result_set($record_result);
    if ($num_of_results == 0) {
        return $src;
    }


    while ($row = $database->fetch_array($record_result)) {
        // If there's no valid pic src, then the default pic src,
        // otherwise return the valid pic src.
        if (
            (!isset($row["pic_url"])) ||
            (empty($row["pic_url"])) ||
            (is_null($row["pic_url"])) ||
            (($row["pic_url"] === 0))
        ) {
            break;
        } else {
            $src = $row["pic_url"];
        }

        //
        return $src;
    }
}

function show_user_home_icon($user_id = 0, $icon_class, $menu, $label = "")
{

    $src = b_get_profile_pic_src($user_id);

    if (isset($src)) {
        echo "<img src=\"{$src}\" class=\"{$icon_class}\">{$label}";
    } else {
        show_default_user_home_icon($icon_class, $menu, $label);
    }
}

function show_default_user_home_icon($icon_class, $menu, $label = "")
{
    switch ($menu) {
        case "user_home":
        case "profile":
            echo "<i class=\"fa fa-user-circle-o {$icon_class} b-i-{$icon_class}\"></i>";
            break;
        case "wall":
            echo "<i class=\"fa fa-th-list {$icon_class} b-i-{$icon_class}\"></i>";
//            echo "<i class=\"material-icons {$icon_class} b-i-{$icon_class}\">x</i>";
            break;
    }

    echo "{$label}";

}

?>