<div>
    <input id="search_input" placeholder="Search...">
    <!--<a id="search_a" href="#">-->
        <!--<img id="search_img" src="<?php // echo LOCAL . '/public/_photos/icon_search.png';   ?>" class="header_icon">-->
    <!--</a>-->
    <input id="search_button" type="image" src="<?php echo LOCAL . '/public/_photos/icon_search.png'; ?>">

    <ul id="search_suggestions"></ul>
</div>






<style>
    #search_suggestions {
        box-shadow: 3px 3px 15px rgb(100, 100, 100);
        position: absolute;
        width: 465px;
        /*height: 100px;*/

        background-color: white;
        border-radius: 3px;
        display: none;
        list-style: none;
    }

    /*    #search_suggestions li {
            padding: 10px;
            padding-right: 36px;
        }*/

    #search_suggestions a:hover {
        background-color: lightyellow;
    }

    #search_suggestions a {
        display: block;
        /*background-color: blue;*/
        /*width: 450px;*/
        font-size: 12px;
        font-weight: 100;
        color: black;
        padding: 10px;
        padding-right: 36px;
    }

    #search_suggestions li {
        color: black;
    }    

    #search_button {
        /*background-color: orange;*/
        background-color: rgb(150, 150, 150);
        border-radius: 5px;
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        margin-left: 0;
        margin-top: 18px;
        height: 30px;
        padding: 3px;
    }

    #search_button:hover {
        background-color: rgb(200, 200, 200);
    }    
</style>