<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>

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
                // TODO
                echo "<h4>zZzzZz</h4>";
                echo "<a href='" . LOCAL . "/public/__view/view_signup.php'>Sign-up</a>";
                ?>
            </div>





            <div id="divWebsite">
                <h4 id="h4Website">FatBoy &reg;</h4>
            </div>
        </div>




        <nav id="navSide">
            <a href="<?php echo LOCAL . '/public/index.php'?>" class="">Timeline
            </a>
            <a href="profile.php" class="">Profile</a>
            <a href="friends.php" class="">Friends</a>

            <a href="my_videos.php" class="">MyVideos</a>
            <a href="my_store.php">MyStore</a>


        </nav>
        <main id="main">
