class API {

    /* Getting the data for grid */
    static getDataGrid(level){
        this.level = level;
        return new Promise((resolve, reject) =>{

            let request = new XMLHttpRequest();
            request.open("GET", "https://raw.githubusercontent.com/mileprogramer/data_memory_game/main/data.json?token=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")
            request.send();
            
            request.addEventListener("readystatechange", acceptData.bind(this));

            function acceptData(){
                
                if(request.status === 200 && request.readyState === 4){
                    let data = JSON.parse(request.responseText);

                    data = data.find((lvl)=>{
                        return lvl.nameLvl === this.level;
                    });
                    resolve(data)
                }
            }
        })
    }

    /* Getting photos grom pexels API */
    static getPhotos(numPictures){
        let header = new Headers();
        header.append("Authorization", "erOnLPPGMk1LM7tryk9j4nHyBp3pO6YMGfjqDdiEVntNBplV8zPpFLv3");

        let request = new Request(`https://api.pexels.com/v1/search?query=nature?per_page=${numPictures}`, {
            method : "GET",
            headers : header,
        });

        return new Promise((resolve, reject) =>{
            fetch(request)
                .then((promise) =>{
                    return promise.json();
                })
                .then((data)=>{
                    resolve(data)
                });
        })    
    }
}

