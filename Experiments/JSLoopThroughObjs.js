var user_info = {
    name : "bren",
    last : "baga"
};

for (var info in user_info) {
    if(user_info.hasOwnProperty(info)) {
        console.log("user_info.info: " + user_info.info);
    }

    // // your code
    // alert(prop + " = " + obj[prop]);
}
