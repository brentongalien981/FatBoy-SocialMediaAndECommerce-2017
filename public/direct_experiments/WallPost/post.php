<!DOCTYPE html>
<html>
<head>
    <title>Font Awesome Icons</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div id="wall">
    <div class="b-post">
        <div class="b-post-details-bar">
            <div>
                <img src="https://farm5.staticflickr.com/4365/36521302700_aeb8485cf2_q.jpg">
            </div>

            <div class="meta-details">
                <h5 class="meta-name">Allen Iverson</h5>
                <h6 class="meta-date">Aug. 31, 2017</h6>
            </div>

            <div class="settings-icon-container">
                <i class="fa fa-sliders settings-icon"></i>
            </div>

        </div>

        <div class="b-post-main-content">
            content
        </div>

        <div class="b-post-response-bar">
            response
        </div>

        <div class="b-post-comments">
            comments
        </div>

        <div class="b-post-comment-textarea">
            textarea
        </div>
    </div>
</div>


<style>
    * {
        padding: 0;
        margin: 0;
        border: none;
    }

    #wall {
        width: 700px;
        height: 1000px;
        background-color: gray;
    }

    .b-post {
        width: 500px;
        /*height: 900px;*/
        background-color: white;
    }

    .b-post-details-bar {
        width: 100%;
        /*height: 100px;*/
        background-color: lightblue;
    }

    .b-post-details-bar div {
        display: inline-block;
        vertical-align: top;
        /*height: 50px;*/
    }

    .b-post-details-bar img {
        width: 50px;
        height: 50px;
        border-radius: 3px;
    }

    .b-post-details-bar .meta-details {

        background-color: lightpink;
    }

    .meta-name {
        background-color: lightcyan;

    }

    .meta-date {
        background-color: lightgoldenrodyellow;
    }

    .settings-icon-container {

    }

    .settings-icon {
        font-size: 16px;
    }

    .b-post-main-content {
        width: 100%;
        height: 300px;
        background-color: yellow;
    }

    .b-post-response-bar {
        width: 100%;
        height: 50px;
        background-color: blue;
    }

    .b-post-comments {
        width: 100%;
        height: 300px;
        background-color: yellow;
    }

    .b-post-comment-textarea {
        width: 100%;
        height: 150px;
        background-color: blue;
    }
</style>


</body>
</html>