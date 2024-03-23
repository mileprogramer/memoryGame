class Grid{
    constructor(gridData, gridPhotos, containerGame){
        this.gridData = gridData;
        this.gridPhotos = gridPhotos;
        this.containerGame = containerGame;

        this.makeGrid(gridData, gridPhotos, containerGame);
    }

    makeGrid(gridData, gridPhotos, containerGame){
        let container = document.createElement("div");
        let numField = gridData.grid[0] * gridData.grid[1];
        let cardSize = gridData.cardSize;
        let fragment = document.createDocumentFragment();
        let photos = this.duplicatePhotos(gridPhotos);
        photos = this.randomizeImages(photos);


        /* Setting values to zero, so that on a new level values will be default values*/
       /*  Card.allCards.length = 0;
        Card.twoFliped.length = 0;
        Card.fliped = 0;
        Card.attempts = 0;
        Card.winFliped = numField / 2;
 */
        Game.winFliped = numField / 2;

        let counter = photos.length-1;
        for(let i = 0; i < numField; i++){

            (photos[counter] === undefined)? counter = photos.length-1: false;
            
            let newCard = new Card(photos[counter].src.tiny, cardSize);
            fragment.append(newCard.htmlElement);
            counter--;
        };

        container.style.gridTemplateRows = `repeat(${gridData.grid[0]}, 1fr)`;
        container.style.gridTemplateColumns = `repeat(${gridData.grid[1]}, 1fr)`;
        container.classList.add("container");

        container.append(fragment);
        containerGame.append(container);
    }

    duplicatePhotos(gridPhotos){
        let arr = [];

        for(let i = 0; i<gridPhotos.length; i++){

            arr.push(gridPhotos[i]);
            let copyImg = gridPhotos[i];
            arr.push(copyImg);
        
        }
        
        return arr;
    }

    randomizeImages(images){
        let rand = null;
        let temp = null;

        for(let i = images.length-1; i > 0; i--){
            rand = Math.floor(Math.random()*images.length-1);
            temp = images[i];
            images[i] = images[rand];
            images[rand] = images[i]
        }

        return images;
    }
}