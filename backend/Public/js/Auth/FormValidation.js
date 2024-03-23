class FormValidation{

    constructor(mistakeDiv){

        this.mistakeDiv = mistakeDiv;
        this.checkRules = {
            "notEnoughLong": value => (value.length >= 5)? true: false,
        };
        this.mistakes = {
            "notEnoughLong": (element) => `Please enter the value for ${element} longer than 5 characters`,
        };

    }

    validateData(inputs, erors){

        for(let i = 0; i<inputs.length; i++){
            for(const rule in this.checkRules){
                if(this.checkRules[rule](inputs[i].value) === false){
                    erors.push({
                        element: inputs[i],
                        mistake: this.mistakes[rule](inputs[i].getAttribute("name"))
                    });
                }
            }
        }

        return erors;
    }

    outputMistake(mistakes){
        this.mistakeDiv.innerHTML = "";
        mistakes.forEach(mistake =>{

            mistake.element.classList.add("mistake");
            this.mistakeDiv.innerHTML += `<p>${mistake.mistake}</p>`;

        });        
    }

    emptyInputValue(inputs){
        inputs.forEach(input => input.value = "");
    }

    resetMistake(inputs){
        inputs.forEach(element => {
            (element.classList.contains("mistake"))? element.classList.remove("mistake"): false;
        });
        this.mistakeDiv.innerHTML = "";
    }
}