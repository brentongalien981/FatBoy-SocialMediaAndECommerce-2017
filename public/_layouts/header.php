<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>
<?php
if ($session->is_logged_in() && $session->is_viewing_own_account()) {
    // TODO:REMINDER: Delete this after you've completely refactored the notification subsystem.
//    require_once(PUBLIC_PATH . "/__controller/controller_notifications_notifier.php");
}
?>

<!doctype>
<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/_layouts/header.css"; ?>">
    </head>
    <body>
        <?php // TODO:REMINDER: Display this later. ?>
        <!--<div id="the_spinner_div">-->
            <!--<img id="the_spinner_mg" src="<?php // echo LOCAL . "/public/_photos/loading1.gif";     ?>">-->
        <!--</div>-->



        <input id="input_currently_viewed_user_id" type="hidden"
        <?php
        global $session;
        echo " value='";

        if (isset($session->currently_viewed_user_id)) {
            echo $session->currently_viewed_user_id;
        }

        echo "'>";
        ?>


               <input id="input_currently_viewed_user_name" type="hidden"
               <?php
               // This input is used to control the currently_viewed_user_id
               // on multiple tabs.
               echo " value='";

               if (isset($session->currently_viewed_user_name)) {
                   echo $session->currently_viewed_user_name;
               }

               echo "'>";
               ?>



               <div id="divBanner">


            <table id="header">
                <tr>
                    <td class="header" id="status">
                        <div id="divStatus">
                            <?php
                            $profile_pic_url = "/public/_photos/icon_home.png";

                            if ($session->is_logged_in()) {
//                                echo "<a class='user_name' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>Hello {$session->actual_user_name}!</a>";
//                                echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                                echo "<a id='link_home' href='" . LOCAL . "/public/reset_to_actual_user.php?is_viewing_actual_user_again=1'>";

                                //
                                global $session;
                                $query = "SELECT * FROM Profile ";
                                $query .= "WHERE user_id = {$session->actual_user_id}";

                                $record_result = Profile::read_by_query($query);


                                global $database;
                                while ($row = $database->fetch_array($record_result)) {
                                    $profile_pic_url = $row["pic_url"];

                                    if ($profile_pic_url == null || $profile_pic_url == "") {
                                        $profile_pic_url = "/public/_photos/icon_home.png";
                                    }

                                    break;
                                }

//                                echo "<img src='" . LOCAL . "/public/_photos/icon_home.png' class='header_icon'>";
                                echo "<img src='" . LOCAL . "{$profile_pic_url}' class='header_icon'>";
//                                echo "Hello {$session->actual_user_name}!";
                                echo "</a>";
                            } else {
                                $profile_pic_url = "/public/_photos/icon_home.png";

//                                echo "<a class='user_name'>zZzzZz</a>";
//                                echo "<a href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a>";
                                echo "<a id='link_home' href='#'>";
                                echo "<img src='" . LOCAL . "{$profile_pic_url}' class='header_icon'>";
                                echo "</a>";
                            }
                            ?>
                        </div>
                    </td>


                    <?php
// Pop-up when home icon is hovered.
                    if ($session->is_logged_in()) {
                        echo "<div id='pop_up_for_link_home'>";
//                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__view/view_log_in.php>Log-in</a><br>";
//                        echo "<a href='' class='pop_up_links'>Sign-up</a><br>";

                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                        echo "</div>";
                    } else {
                        echo "<div id='pop_up_for_link_home'>";
                        echo "<a id='first_pop_up_link' class='pop_up_links' href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a><br>";
                        echo "<a href='" . LOCAL . "/public/__view/view_signup.php' class='pop_up_links'>Sign-up</a><br>";
                        echo "</div>";
                    }
                    ?>






                    <td class="header" id="search">
                        <?php require_once(PUBLIC_PATH . "/__view/search/create.php"); ?>
                    </td>

                    <td class="header" id="site_logo">
                        <h4 id="logo_fatboy">FatBoy &reg;</h4>
                        <!--                        <div id="divWebsite">
                                                    <h4 id="h4Website">FatBoy &reg;</h4>
                                                </div>-->
                    </td>
                </tr>
            </table>

        </div>





        <div id="main">
            <table id="the_table">
                <tr>
                    <td id="left" class="main">
                        <div id="container_for_nav_side">
                            <?php require_once(PUBLIC_PATH . "/_layouts/side_nav.php"); ?>
                        </div>
                    </td>

                    <td id="middle" class="main">
                    </td>

                    <td id="right" class="main">
                        <div id="ad_container">
                            <iframe id="the_ad" class="ad" frameborder="0" allowfullscreen="false" mozallowfullscreen="false" scrolling="no" seamless=""></iframe>
                        </div>
                    </td>
                </tr>
            </table>
        </div>



        <!--<main id="main">-->

        <!--Sub-menus-->
        <!--<nav id="sub_menus_nav">-->



        <link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/_layouts/header2.css"; ?>">



        <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
        </script>        

        <?php
// TODO:SECTION: General js scripts that needs <php> tags.
        ?>
        <script>
            function get_csrf_token() {
                return "<?php echo sessionize_csrf_token(); ?>";
            }

            function get_local_url() {
                return "http://localhost/myPersonalProjects/FatBoy";
            }
        </script>


        <script src="<?php echo LOCAL . "/public/_scripts/general.js"; ?>">
        </script>

        <?php
// TODO: SECTION: Script for popping-in and
// popping out of the sign-in, sign-up links.
        ?>

        <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
        </script>

        <script src="<?php echo LOCAL . "/public/_scripts/main_script_part2.js"; ?>"></script>

        <script>

            window.onfocus = function () {
                //                window.alert("main content loaded");
                console.log("this tab is now focused and active: " + document.getElementById("title").innerHTML);
                set_session_currently_viewed_user_id();
            };

            function set_session_currently_viewed_user_id() {
                var xhr = new XMLHttpRequest();

                var url = "<?php echo LOCAL . "/public/__controller/controller_session.php"; ?>";
                xhr.open('POST', url, true);
                // You need this for AJAX POST requests.
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    // If ready..
                    if (xhr.readyState == 4 && xhr.status == 200) {

                        // If there's a successful response..
                        if (xhr.responseText.trim().length > 0) {
                            console.log("SUCCESS AJAX for method: set_session_currently_viewed_user_id().");
                        }

                    }


                }

                //uki
                var post_key_value_pairs = "input_currently_viewed_user_id=" + document.getElementById("input_currently_viewed_user_id").value;
                post_key_value_pairs += "&input_currently_viewed_user_name=" + document.getElementById("input_currently_viewed_user_name").value;
                xhr.send(post_key_value_pairs);
            }
        </script>

        <script src="<?php echo LOCAL . "/public/_scripts/user_home_menus_displayer.js"; ?>"></script>




        <?php // TODO:SECTION: AJAX script for search. ?>
        <?php require_once(PUBLIC_PATH . "/_scripts/search/ajax_create.php"); ?>
        <?php require_once(PUBLIC_PATH . "/_scripts/notifications/count_displayer.php"); ?>











