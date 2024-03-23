class Game{
    
    static allCards = [];
    static twoFliped = [];
    static attempts = 0;
    static fliped = 0;

    static startGame(level, containerGame, durationFlipCard){
        this.level = level;
        this.containerGame = containerGame;
        this.durationFlipCard = durationFlipCard;

        let newLevel = new Level(this.level, this.containerGame);
    }
    static checkIsSame(){

        let firstCard = Game.twoFliped[0];
        let secondCard = Game.twoFliped[1];
        let firstImg = firstCard.querySelector("img");
        let secondImg = secondCard.querySelector("img");

        if(firstImg.src === secondImg.src){
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


    static endGame(result){
        // Removing all clicks to all cards and stoping timer
        Game.removeCardsClick();
        clearInterval(Timer.loop);
        Game.popup(result);
    }

    static popup(result){
        let attempts = Card.attempts;
        let nextLevel = Game.level;
        nextLevel++;
        let noti = {
            "win": {
                output: `You win this level in ${attempts} attempts, your next level is ${nextLevel}`,
                btnText: "Next level"
            },

            "lose":{
                output: `You lost, you had ${attempts} attempts`,
                btnText: "Play again"
            },

            "endGame":{
                output: `You solved the game!!! Congrats!!!`,
                btnText: "Play again"
            }
        }

        let notiDiv = document.createElement("div");
        let notiP = document.createElement("p");
        let button = document.createElement("button");
        let buttonReveal = document.createElement("button");
        
        
        buttonReveal.onclick = Game.revealAllCards;

        buttonReveal.className = "btnReveal";
        notiP.textContent = noti[result].output;
        button.textContent = noti[result].btnText;
        buttonReveal.textContent = "Reveal all cards";

        /* if(result === "win") buttonReveal = ""; */

        notiDiv.className = "noti";
        notiDiv.append(notiP, button, buttonReveal);
        let containerGame = document.getElementById("container-game");
        containerGame.append(notiDiv);
    }


    static revealAllCards(){
        console.log("radi revealAllCard");
        let cards = Card.allCards;
        for(let i =0; i<cards.length; i++){

            if(!cards[i].classList.contains("active")){

                cards[i].classList.add("active");

            }
        }
    }
}