class API {

    /* Getting the data for grid */
    static getData(level){
        this.level = level;
        return new Promise((resolve, reject) =>{

            let request = new XMLHttpRequest();
            request.open("GET", `http://localhost/memoryGame/api/${this.level}`)
            request.send();
            
            request.addEventListener("readystatechange", function(){
                if(request.status === 200 && request.readyState === 4){
                    let data = JSON.parse(request.responseText);
                    resolve(data)
                }
            });
        })
    }

    static getTotalLevels(){

        return new Promise(function(resolve, reject){
            fetch(`http://localhost/memoryGame/api/total_levels`)
                .then(function(response){
                    if(response.status === 200){
                        return response.text();
                    }
                })
                .then(function(responseText){
                    let data = JSON.parse(responseText).total_levels;
                    resolve(data);
                })
                .catch(function(error){
                    reject(error);
                })
        });
    }
}

