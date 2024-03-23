class FormController{

    constructor(form, mistakeDiv){
        
        this.form = form;
        this.mistakeDiv = mistakeDiv;
        this.mistakes = [];
        this.formValidation = new FormValidation(mistakeDiv);
        this.inputs = form.querySelectorAll("input");

        this.form.addEventListener("submit", this.formSubmit);
    }

    formSubmit = (e) =>{
        this.mistakes.length = 0;
        e.preventDefault();        
        this.mistakes = this.formValidation.validateData(this.inputs, this.mistakes);

        if(this.mistakes.length === 0){
            this.form.submit();
            this.formValidation.resetMistake(this.inputs);
        }else{
            this.formValidation.outputMistake(this.mistakes);
        }
    }

}