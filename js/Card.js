class Card{
    static removeAllClicks = null;

    constructor(imgSrc, cardSize){
        this.imgSrc = imgSrc;
        this.cardSize = cardSize;

        this.htmlElement = this.makeCard(imgSrc, cardSize);
        Game.addCardClick = this.flipCard;
    }

    makeCard(imgSrc, cardSize){

        let card = document.createElement("div");
        let back = document.createElement("div");
        let front = document.createElement("div");
        let img = document.createElement("img");

        img.src = imgSrc;

        card.classList.add("card");
        front.classList.add("card-front");
        back.classList.add("card-back");

        card.append(front)
        card.append(back)
        back.append(img);
        card.style.width  = cardSize;
        card.style.height = cardSize;

        card.onclick = this.flipCard;

        Game.allCards.push(card);

        return card;
    }

    flipCard(){
        
        Game.attempts++;
        Game.twoFliped.push(this);
        
        if(Game.twoFliped.length === 2){
            Game.removeCardsClick();
            setTimeout(Game.checkIsSame, Game.durationFlipCard);
        } 

        this.classList.add("active");
        this.onclick = null;
    }

    
}