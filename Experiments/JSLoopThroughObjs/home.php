<script>
    var user_info = {
        name : "bren",
        last : "baga"
    };

    var user_info2 = {};

    for (var info in user_info) {
        if(user_info.hasOwnProperty(info)) {
            console.log("user_info.info: " + info + ":::" + user_info[info]);
            user_info2[info] = user_info[info];
        }

        // // your code
        // alert(prop + " = " + obj[prop]);
    }


    for (var info in user_info2) {
//        if(user_info2.hasOwnProperty(info)) {
            console.log("user_info2.info: " + info + ":::" + user_info2[info]);
//        }
    }
</script>