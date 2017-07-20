// NOTE: Don't ever call this aside from inside
//       METHOD:my_main_sleep_callable().
function my_main_sleep_non_callable(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}




async function my_main_sleep_callable(ms) {
    console.log("******************");
    console.log("I'M SLEEPING");
    await my_main_sleep_non_callable(ms);
    console.log("******************");
    console.log("I'M WAKING");
}