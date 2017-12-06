<?php require_once("master.php"); ?>


<nav id="the-navbar" class="navbar navbar-expand-xl navbar-dark bg-dark">
    <a class="navbar-brand" href="#">FatBoy &copy;</a>


    <form id="the-search-bar" class="form-row">
        <div class="input-group">
            <input id="the-search-box" type="text" class="form-control" placeholder="Search for..." aria-label="Search for...">
            <span class="input-group-btn">
             <button class="btn btn-secondary" type="button">Go!</button>
            </span>
        </div>
    </form>


    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample05"
            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="navbar-collapse collapse" id="navbarsExample05" style="">
<!--        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">-->
        <ul class="nav navbar-nav ml-auto justify-content-end">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Business</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="admin-dropdown-toggle"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                <div class="dropdown-menu" aria-labelledby="admin-dropdown-toggle">
                    <a class="dropdown-item" href="#">User Managament</a>
                    <a class="dropdown-item" href="#">Ad Managament</a>
                </div>
            </li>


        </ul>

    </div>
</nav>


<!--Inside <nav></nav>-->
<!--<form class="form-inline my-2 my-md-0">-->
<!--    <input class="form-control" type="text" placeholder="Search">-->
<!--</form>-->


<script>
    $("body").append($("#the-navbar"));
</script>

<style>
    #the-search-box {
        min-width: 300px;
    }
</style>