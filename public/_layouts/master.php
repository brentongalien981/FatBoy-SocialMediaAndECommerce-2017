<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>


<!doctype html>
<html lang="en">
<head>
    <title id="title">Bootstrapped FatBoy</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- animate.css -->
    <link rel="stylesheet" type="text/css" href="<?= LOCAL . "/public/_styles/animate.css"; ?>">


    <!-- master -->
    <link rel="stylesheet" type="text/css" href="<?= LOCAL . "/public/_styles/_layouts/master.css"; ?>">

    <!-- w3school font-awesome-icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!--TODO: Comment this out on demo/production. You better use the cdn.-->
    <script src="<?php echo LOCAL . "/private/external_lib/jquery-3.2.1.js"; ?>">
    </script>

    <?php require_once(PUBLIC_PATH . "/_scripts/mcn_core_js_scripts.php"); ?>
</head>
<body id="the_body">


<!--nav-->
<?php require_once(PUBLIC_PATH . "/_layouts/nav.php"); ?>



<!-- elements_for_updating_session_user_attribs -->
<?php require_once(PUBLIC_PATH . "/elements_for_updating_session_user_attribs.php"); ?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!--TODO: Uncomment this on demo/productiono.-->
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"-->
<!--        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"-->
<!--        crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>




<!-- Script for updating the session-user-attributes. -->
<!--TODO: Refactor this updating of the session-attributes just like what you did in dawesdental.-->
<?php require_once(PUBLIC_PATH . "/_scripts/mcn_core_js_scripts2.php"); ?>

<!--mcn-loader-el-->
<?php require_once(PUBLIC_PATH . "/general_loader_el.php"); ?>

<!--footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer2.php"); ?>


<!--<div>-->
<!--    --><?php //var_dump($_SESSION); ?>
<!--</div>-->
</body>
</html>



<!--Main scripts-->
<script src="<?= LOCAL . "/public/_scripts/layouts/master/tasks.js"; ?>"></script>
