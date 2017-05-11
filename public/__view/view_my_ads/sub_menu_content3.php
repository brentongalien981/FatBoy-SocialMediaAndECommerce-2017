<!--Imports-->
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_ad.php"); ?>

<?php // defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>











<?php
// TODO: SECTION: Protected page checking.
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() ||
        !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>










<!--Meat-->
<?php
echo "<h3>MyHosted Ads</h3>";

//
show_user_hosted_ads();
?>











<?php
if (isset($_GET["newly_hosted_ad_id"])) {
    // TODO: REMINDER: Highlight the fucking row.
    die("Highlight the fucking row.");
}
?>

<!--<table>
    <tr>
        <td>
            <form>
                <input type="range" min="0" step="0.01" max="100">
            </form>
        </td>
    </tr>
</table>-->











<!--Styles-->
<!--<link href="../_styles/view_shipping.css" rel="stylesheet" type="text/css" />-->
<style>     
</style>





<!--Scripts-->
<!--<script src="../_scripts/view_shipping.js"></script>-->
<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MyHosted Ads";
</script>

<script>

</script>