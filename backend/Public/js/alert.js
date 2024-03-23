let alert = document.querySelector(".alert");
let alertTimer = document.querySelector(".alert-timer");
let width = 0;
let widthOfAlert = parseInt(getComputedStyle(alert).width.slice(0, this.length-2));
let time = 2000;
let increment = ((time / widthOfAlert));

let loop = setInterval(()=>{

    if(width >= widthOfAlert){
        clearInterval(loop);
        alert.style.display = "none";
    }

    alertTimer.style.width = width + "px";
    width = width + increment;

}, 10)

