class Level{
    constructor(level,containerGame){
        this.level = level;
        this.containerGame = containerGame;
        let gridData = null;
        let gridPhotos = null;
        containerGame.innerHTML = "";

        API.getDataGrid(this.level)
            .then((data) =>{
                gridData = data;
                let numPictures = (gridData.grid[0] * gridData.grid[1])/2;

                API.getPhotos(numPictures)
                    .then((data) =>{
                        gridPhotos = data.photos;
                        this.setInfoData(gridData, this.containerGame);

                        // initial delay to add effect
                        setTimeout(()=>{
                            let newLevel = new Grid(gridData, gridPhotos, this.containerGame);
                            let newTimer = new Timer(gridData.time, this.containerGame);
                        }, 700)

                    })
            })
    }

    setInfoData(data, containerGame){

        let infoDiv = document.createElement("div");
        let nameLevel = document.createElement("h1");
        let timeRest = document.createElement("div");
        let h4 = document.createElement("h4");
        let currentTime = document.createElement("h5");
        let allTime = document.createElement("h5");
        
        infoDiv.classList.add("info")
        nameLevel.textContent = `Level ${data.nameLvl}`;
        h4.textContent = "Time:";
        allTime.textContent = `/${data.time}`;
        currentTime.classList.add("current-time");

        timeRest.classList.add("time-rest");
        timeRest.append(h4);
        timeRest.append(currentTime);
        timeRest.append(allTime);
        infoDiv.append(nameLevel);
        infoDiv.append(timeRest);
        containerGame.append(infoDiv);
    }

}
/* Pexels */
/* MY API KEY erOnLPPGMk1LM7tryk9j4nHyBp3pO6YMGfjqDdiEVntNBplV8zPpFLv3 */


