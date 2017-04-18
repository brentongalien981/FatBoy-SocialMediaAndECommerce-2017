<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>


<?php define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>

<!doctype>
<html>
    <head>
        <title id="title">&copy; FatBoy</title>
        <link href="../_styles/header.css" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="divBanner">



            <div id="divStatus">
                <?php
                if ($session->is_logged_in()) {
                    echo "<h4>{$session->actual_user_name}</h4>";
                    echo "<a href='" . LOCAL . "/public/__controller/log_out.php'>Log-out</a>";
                } else {
                    echo "<h4>zZzzZz</h4>";
                    echo "<a href='" . LOCAL . "/public/__view/view_log_in.php'>Log-in</a>";
                }
                ?> 
            </div>





            <div id="divWebsite">
                <h4 id="h4Website">FatBoy &reg;</h4>
            </div>
        </div>




        <nav id="navSide">
            <a href="<?php echo LOCAL . '/public/index.php'; ?>" class="">Timeline</a>
            <a href="<?php echo LOCAL . '/public/__view/view_profile.php'; ?>" class="">Profile</a>
            <a href="friends.php" class="">Friends</a>

            <a href="<?php echo LOCAL . '/public/__view/view_my_videos.php'; ?>" class="">MyVideos</a>
            <a href="my_store.php">MyStore</a>

            <?php
            if (!$session->is_logged_in()) {
                echo "<a href='" . LOCAL . "/public/__view/view_signup.php'>Sign-up</a>";
            }
            ?>
        </nav>
        <main id="main">
