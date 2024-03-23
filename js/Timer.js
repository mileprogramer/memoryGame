class Timer{
    static loop;
    static objTime = {
        diff: 0,
        increment : 0,
        time : 0,
        infoRestTime : null,
        timeHeigth: null
    }
    constructor(time){
        this.time = time;
        Timer.objTime.infoRestTime = document.querySelector(".time-rest .current-time");

        this.startTimer(this.time);
    }

    startTimer(time){
        /* time is string for example time = "120s" */
        time = time.substring(0, time.length-1);
        Timer.objTime.time = parseInt(time);
        
        // creating html and adding into container-game
        let timerDiv = document.createElement("div");
        this.addHTML(timerDiv);

        /* Calculating divHeight to get with what value i have to increase height of div(that represent time left to solve game) */
        let timerDivHeight = +getComputedStyle(timerDiv).height.substring(0, getComputedStyle(timerDiv).height.length-2) - +getComputedStyle(timerDiv).paddingBottom.substring(0, getComputedStyle(timerDiv).paddingBottom.length-2);
        Timer.objTime.diff = timerDivHeight / time;
        Timer.objTime.increment = 0;
        Timer.loop = setInterval(this.loopFunc, 1000);

    }

    addHTML(timerDiv){
        let containerGame = document.getElementById("container-game");
        let timeHeigth = document.createElement("div");
        timerDiv.id = "timer";
        timerDiv.append(timeHeigth);
        containerGame.append(timerDiv);
        Timer.objTime.timeHeigth = timeHeigth;
    }

    loopFunc(){
        Timer.objTime.increment = Timer.objTime.increment + Timer.objTime.diff;
        Timer.objTime.timeHeigth.style.height = Timer.objTime.increment+"px";
        Timer.objTime.time--;
        Timer.objTime.infoRestTime.textContent = Timer.objTime.time+"s";

        if(Timer.objTime.time === 0){

            Timer.objTime.timeHeigth.style.height = "100%";
            Game.endGame("lose");
        };
    }

}