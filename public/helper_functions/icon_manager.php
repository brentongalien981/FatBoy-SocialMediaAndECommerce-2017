<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>

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
        echo "<img id='profile_pic' src=\"{$src}\" class=\"{$icon_class}\">{$label}";
    } else {
        show_default_user_home_icon($icon_class, $menu, $label);
    }
}

/**
 * Usage: Get profile pic's dom element in string form. <img> or <i>
 */
function b_get_profile_pic_el_string($user_id = 0, $menu, $icon_class) {
    $src = b_get_profile_pic_src($user_id);

    if (isset($src)) {
        return "<img src=\"{$src}\" class=\"{$icon_class}\">";
    } else {
        return get_default_icon($icon_class, $menu);
    }
}

function get_default_icon($icon_class, $menu)
{
    switch ($menu) {
        case "post":
            return "<i class=\"fa fa-user-circle-o {$icon_class} b-i-{$icon_class}\"></i>";
            break;
    }

}

function show_default_user_home_icon($icon_class, $menu, $label = "")
{
    switch ($menu) {
        case "user_home":
        case "profile":
            echo "<i id='profile-pic' class=\"fa fa-user-circle-o {$icon_class} b-i-{$icon_class}\"></i>";
            break;
        case "wall":
            echo "<i class=\"fa fa-th-list {$icon_class} b-i-{$icon_class}\"></i>";
//            echo "<i class=\"material-icons {$icon_class} b-i-{$icon_class}\">x</i>";
            break;
    }

    echo "{$label}";

}

?>