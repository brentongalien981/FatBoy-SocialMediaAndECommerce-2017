<div id="notification-widget-container" class="widgets widget-toggled-off">

    <div id="notification-widget-content">

        <div id="notification-widget-header">

            <button id="notification-widget-btn" toggle-state="off" type="button" class="btn btn-primary">
                <i class="fa fa-bell"></i>
                <span class="badge badge-danger">2</span>
            </button>

        </div>

        <nav id="notification-widget-nav"></nav>

        <div id="notification-widget-main-content"></div>

    </div>

</div>





<style>

    #notification-widget-container {
        /*width: 400px;*/
        /*margin-bottom: 150px;*/
    }

    #notification-widget-header {
        /*height: 30px;*/
        background-color: blue;
    }

    #notification-widget-nav {
        height: 40px;
        display: none;
        background-color: pink;
    }

    #notification-widget-main-content {
        height: 100px;
        display: none;
        background-color: gray;
    }
</style>