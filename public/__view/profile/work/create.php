<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php require_once(PUBLIC_PATH . "/__controller/profile/work/create.php"); ?>






<?php
// TODO:SECTION: Pseudo-scripts.
require_once(PUBLIC_PATH . "/_scripts/profile/work/ajax_create.php");
?>