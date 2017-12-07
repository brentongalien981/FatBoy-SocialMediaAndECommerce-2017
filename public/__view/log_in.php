<?php include("../_layouts/master.php"); ?>


<?php
if ($session->is_logged_in()) {
    redirect_to("../index.php");
}
?>


<div id="log-in-form-container" class="container-fluid">
    <form id="formAdminCreation" action="../__controller/controller_log_in.php" method="post">

        <h4>Log-in</h4>
        <?= get_csrf_token_tag() ?>


        <div class="form-group">
            <label for="user_name">Username</label>
            <input type="text"
                   class="form-control"
                   id="user_name"
                   name="user_name"
                   aria-describedby="emailHelp"
                   placeholder="Enter email">
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   class="form-control"
                   id="password"
                   name="password"
                   placeholder="Password">
        </div>


        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input">
                Extra Option
            </label>
        </div>

        <button type="submit" class="btn btn-primary" name="log_in">Submit</button>
    </form>
</div>


<style>
    #formAdminCreation {
        border: 1px solid gray;
        background-color: white;
        padding: 50px;
        margin: 100px;
        border-radius: 5px;
    }

    body {
        background-color: azure;
    }
</style>