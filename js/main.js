(function(){

let point = document.getElementsByClassName("point");
let line = document.getElementsByClassName("line");
let lineWin = document.getElementsByClassName("line-win");
let containerGame = document.getElementById("container-game");
let overlay = document.getElementById("overlay");
let durationFlipCard = 700;
overlay.classList.add("active-overlay")

let level = 2;

Game.startGame(level, containerGame, durationFlipCard);



})();
