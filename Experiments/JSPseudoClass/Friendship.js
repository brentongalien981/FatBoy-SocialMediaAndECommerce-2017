/**
 * Created by ops on 2017-07-09.
 */
function sayMyClassName() {
    window.alert("Class: Friendship");
}

function Friendship() {
    this.className = "Friendship";
    this.getMyClassName = function() {
        return this.className;
    };
    this.showSomeShit = function () {
        window.alert("This is real shit bruh!");
    };
}