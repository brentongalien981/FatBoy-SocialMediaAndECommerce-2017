<?php

// TODO: SECTION: Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<script>
    // Vars.
    var button_add_work_experience = document.getElementById("button_add_work_experience");
    var form_add_work_experience = document.getElementById("form_add_work_experience");





    // Tasks.
    hide_test_work_exp_div();





    // Event listeners.
    // Add work experience.
    if (button_add_work_experience != null) {
        button_add_work_experience.addEventListener("click", function () {
            show_form_add_work_experience();
            this.style.display = "none";
        });
    }





    // Functions.
    function hide_test_work_exp_div() {
        document.getElementById("-69").style.display = "none";
    }

    function show_form_add_work_experience() {

        form_add_work_experience.style.display = "block";
    }
</script>