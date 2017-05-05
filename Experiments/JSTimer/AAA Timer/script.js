// Global variables
var intervalHandle;
var timeRemaining;

window.onload = function() {
    waitForClick();
};

function waitForClick() {
    var click = document.getElementById("click");
    click.onclick = function() {
        createTimerTools(click);
    };
}

function createTimerTools(click) {
    // create textbox
    var minuteTextbox = document.createElement("input");
    minuteTextbox.setAttribute("id", "minuteTextbox");
    minuteTextbox.setAttribute("type", "text");
    
    // create button
    var startButton = document.createElement("input");
    startButton.setAttribute("type", "button");
    startButton.setAttribute("value", "startCountdown");
    
    // add the textbox and button to the page
    document.getElementById("timerArea").appendChild(minuteTextbox);
    document.getElementById("timerArea").appendChild(startButton);
    
    // delete the click element
    click.style.display = "none";
    
    // add event handler to the button
    startButton.onclick = function() {
        startCountdown();
    };
}

function startCountdown() {
    // get the seconds
    var time = document.getElementById("minuteTextbox").value;
    
    // check if Not a Number
    if (isNaN(time)) {
        alert("should be a number");
        return;
    }
    
    // set the time to the time -- yun oh!
    timeRemaining = time;
    
    // Call the tick function every second.
    // setInterval() is built-in.
    intervalHandle = setInterval(tick, 1000);
}

function tick() {
    if (timeRemaining == 0) { 
        // Built-in method.
        clearInterval(intervalHandle);
        alert("hiiiiizzzz hoooovvveeerrr");
    }
    
    document.getElementById("time").innerHTML = timeRemaining;
    --timeRemaining;
}