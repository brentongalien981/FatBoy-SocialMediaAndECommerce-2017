<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>

<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>






<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

// TODO: SECTION: LOG.
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// TODO: SECTION: Functions.
function show_user_profile_summary() {
    echo "<div class='section'>";
    echo "<h4>About Me</h4>";

    echo "<div id='div_about_me'>";

    $profile_pic_src = get_profile_pic_src();
    echo "<img src='" . LOCAL . "{$profile_pic_src}'>";

    $profile_description = get_profile_description();
    echo "<p>";
    echo $profile_description;
    echo "</p>";
    
    echo "</div>";
    echo "</div>";
}

function get_profile_description() {
    global $session;
    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";

    $record_result = Profile::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        return $row["description"];
    }
}

function get_profile_pic_src() {
    global $session;
    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$session->currently_viewed_user_id}";

    $record_result = Profile::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        return $row["pic_url"];
    }
}
?>





<?php

// TODO: SECTION: Meat.
?>