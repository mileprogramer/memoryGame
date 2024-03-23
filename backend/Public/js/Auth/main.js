(function(){
// DOM
let formElement = document.querySelector("form");
let mistakeDiv =  document.getElementById("mistakes");
let passwordInput = document.getElementById("password");
let showPasswordBtn = document.querySelector(".show-password");
let hidePasswordBtn = document.querySelector(".hide-password");


// Class
let loginForm = new FormController(formElement, mistakeDiv);

// event listeners

showPasswordBtn.addEventListener("click", displayPassword);
hidePasswordBtn.addEventListener("click", displayPassword);

// functions
function displayPassword(){

    let whoCallMe = this.textContent; // Show or Hide

    if(whoCallMe === "Show"){
        passwordInput.type = "text";
        this.classList.add("unactive");
        hidePasswordBtn.classList.remove("unactive");
    }
    else if(whoCallMe === "Hide")
    {
        passwordInput.type = "password";        
        this.classList.add("unactive");
        showPasswordBtn.classList.remove("unactive");
    }
}


})();

