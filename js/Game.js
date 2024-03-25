class Game{
    
    static totalLevels = 0;
    static level = 0;
    static allCards = [];
    static twoFliped = [];
    static attempts = 0;
    static fliped = 0;
    static winFliped = 0;
    static endOfGame = null;

    static async startGame(level, containerGame, durationFlipCard){

        this.level = level;
        this.containerGame = containerGame;
        this.durationFlipCard = durationFlipCard;

        let newLevel = new Level(this.level, this.containerGame);
        (this.totalLevels === 0)? Game.totalLevels = await API.getTotalLevels(): false;
        let data = await newLevel.getData();
        newLevel.setInfoData(data);
        this.setValues(data);
        let time = data.time_to_solve * this.getUnit(data.unit);
        let newGrid = new Grid(data, containerGame);
        let newTimer = new Timer(time);

    }

    static endGame(result){

        // checking if user trigger endGame two times
        if(Game.endOfGame === null){ 
            (Game.level === Game.totalLevels && result === "win")? Game.popup("endGame") : Game.popup(result);
            Game.endOfGame = true;
        }
        // Removing all clicks to all cards and stoping timer
        Game.resetValues();
        Game.removeCardsClick();
        clearInterval(Timer.loop);

    }

    static setValues(data){

        Game.winFliped = ((data.num_rows * data.num_columns)/ 2);
        Game.fliped = 0;
        Game.allCards = [];
        Game.twoFliped = [];
        Game.attempts = 0;
    }

    static resetValues(winFlipedValue){
        Game.attempts = 0;
        Game.winFliped = winFlipedValue;
        Game.fliped = 0;
        Game.endOfGame = null;
    }

    static getUnit(unit){
        let returnUnit = null;
        switch(unit){
            case "seconds":
                returnUnit = 1000
                break;
            case "minutes":
                returnUnit = 1000 * 60
                break;
        }
        return returnUnit;
    }

    static checkIsSame(){

        let firstCard = Game.twoFliped[0];
        let secondCard = Game.twoFliped[1];
        let firstImg = firstCard.querySelector("img");
        let secondImg = secondCard.querySelector("img");

        if(firstImg.src === secondImg.src){
            Game.attempts++;
            Game.fliped++;
            Game.twoFliped.length = 0;
            /* Check is user solve the level */
            (Game.fliped === Game.winFliped)? Game.endGame("win"): Game.addClickAgain();
            
            
        }else{
            firstCard.classList.remove("active");
            secondCard.classList.remove("active");
            Game.twoFliped.length = 0;
            Game.addClickAgain();
        }

    }

    static removeCardsClick(){
        Game.allCards.forEach(card =>{ card.onclick = null});
    }

    static addClickAgain(){
        Game.allCards.forEach(card => (!card.classList.contains("active"))?  card.onclick = Game.addCardClick : false);
    }

    static popup(result){

        let attempts = Game.attempts;
        let nextLevel = parseInt(this.level) + 1;
        let noti = {
            "win": {
                output: `You win this level in ${attempts} attempts, your next level is ${nextLevel}`,
                btnText: "Next level",
                btnAttribute : nextLevel
            },
            
            "lose":{
                output: `You lost, you had ${attempts} attempts`,
                btnText: "Play again",
                btnAttribute : this.level
            },

            "endGame":{
                btnText: "Play again",
                btnAttribute : 1,
                background: `<div class="endGamepopup"><h3>You solved the game!!! Congrats!!!</h3><img src="http://localhost/memoryGame/img/leonardo-dicaprio-clapping.gif">`
            }
        }

        if(result === "endGame"){
            this.containerGame.innerHTML = noti.endGame.background;
            return "";
        }

        // making elements
        let notiDiv = document.createElement("div");
        let notiP = document.createElement("p");
        let button = document.createElement("button");
        let buttonReveal = document.createElement("button");
        
        // events
        buttonReveal.onclick = Game.revealAllCards;
        button.addEventListener("click", ()=>{
            Game.startGame(button.getAttribute("data-level"), this.containerGame, this.durationFlipCard);
        });

        // text
        buttonReveal.className = "btnReveal";
        notiP.textContent = noti[result].output;
        button.textContent = noti[result].btnText;
        buttonReveal.textContent = "Reveal all cards";

        if(result === "win"){
            this.level++;
            buttonReveal = "";
            button.setAttribute("data-level", noti.win.btnAttribute)
        }
        else if(result === "lose"){
            button.setAttribute("data-level", noti.lose.btnAttribute)
            
        }

        // appending
        notiDiv.className = "noti";
        notiDiv.append(notiP, button, buttonReveal);
        let containerGame = document.getElementById("container-game");
        containerGame.append(notiDiv);
    }


    static revealAllCards(){

        let cards = Game.allCards;
        for(let i =0; i<cards.length; i++){

            if(!cards[i].classList.contains("active")){

                cards[i].classList.add("active");

            }
        }
    }
}