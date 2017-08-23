<div id="scrolling_div">

    <?php for ($i = 0; $i < 5; $i++) { ?>

    <div class="img_containers">


        <img class="imgs" id="the_img" src="https://media.mnn.com/assets/images/2014/12/gray-squirrel-uc-berkeley.jpg.560x0_q80_crop-smart.jpg">

        <div class="captions">
            <?= "caption{$i}" ?>
        </div>

    </div>

    <?php } ?>

</div>

<style>
    #scrolling_div {
        width: 1400px;
        height: 500px;
        background-color: lightblue;
        overflow: auto;
    }

    .img_containers {
        display: inline-block;
    }
    .imgs {
        /*width: 300px;*/
        /*height: 200px;*/
        background-color: yellow;
        display: inline-block;
    }

    .captions {
        width: 300px;
        height: 100px;
        background-color: lightpink;
        /*position: relative;*/
        /*top: -180px;*/
        display: inline-block;
    }
</style>