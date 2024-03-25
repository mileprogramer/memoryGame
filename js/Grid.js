class Grid{
    constructor(data, containerGame){
        this.data = data;
        this.containerGame = containerGame;

        this.makeGrid(containerGame);
    }

    makeGrid(containerGame){
        let container = document.createElement("div");
        let numField = this.data.num_rows * this.data.num_columns;
        let cardSize = this.data.card_size;
        let fragment = document.createDocumentFragment();
        let photos = this.duplicatePhotos(this.data.images);
        photos = this.randomizeImages(photos);

        for(let i = 0; i < numField; i++){

            let newCard = new Card(photos[i], cardSize);
            fragment.append(newCard.htmlElement);
            
        };

        container.style.gridTemplateRows = `repeat(${this.data.num_rows}, 1fr)`;
        container.style.gridTemplateColumns = `repeat(${this.data.num_columns}, 1fr)`;
        container.classList.add("container");

        container.append(fragment);
        containerGame.append(container);
    }

    duplicatePhotos(gridPhotos){
        let arr = [];
        
        for(let i = 0; i<gridPhotos.length; i++){
            
            arr.push(gridPhotos[i], gridPhotos[i]);
            
        }
        
        return arr;
    }

    randomizeImages(images) {
        for (let i = images.length - 1; i > 0; i--) {
            const rand = Math.floor(Math.random() * images.length);

            const temp = images[i];
            images[i] = images[rand];
            images[rand] = temp;
        }
        return images;
    }
}