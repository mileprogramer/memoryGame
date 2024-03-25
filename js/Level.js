class Level{
    constructor(level,containerGame){
        this.level = level;
        this.containerGame = containerGame;
        let gridData = null;
        let gridPhotos = null;
        containerGame.innerHTML = "";

    }

    getData() {
        
        return API.getData(this.level);
    }

    setInfoData(data){

        let infoDiv = document.createElement("div");
        let nameLevel = document.createElement("h1");
        let timeRest = document.createElement("div");
        let h4 = document.createElement("h4");
        let currentTime = document.createElement("h5");
        let allTime = document.createElement("h5");
        
        infoDiv.classList.add("info")
        nameLevel.textContent = `Level ${this.level}`;
        h4.textContent = "Time:";
        allTime.textContent = `/${data.time_to_solve}${data.unit}`;
        currentTime.classList.add("current-time");

        timeRest.classList.add("time-rest");
        timeRest.append(h4);
        timeRest.append(currentTime);
        timeRest.append(allTime);
        infoDiv.append(nameLevel);
        infoDiv.append(timeRest);
        this.containerGame.append(infoDiv);
    }

}