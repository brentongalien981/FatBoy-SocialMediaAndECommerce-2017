<div>
    <input id="search_input" placeholder="Search...">
    <!--<a id="search_a" href="#">-->
        <!--<img id="search_img" src="<?php // echo LOCAL . '/public/_photos/icon_search.png';  ?>" class="header_icon">-->
    <!--</a>-->
    <input id="search_button" type="image" src="<?php echo LOCAL . '/public/_photos/icon_search.png'; ?>">
    
    <ul id="search_suggestions"></ul>
</div>






<style>
    #search_suggestions {
        position: absolute;
        width: 465px;
        height: 100px;
        background-color: yellow;
        border-radius: 3px;
        display: none;
        list-style: none;
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