// DOM
let form = document.querySelector("#form");
let btnOpenModal = document.querySelectorAll(".change-image");
let modalChangeImage = document.getElementById("modal-image-change");
let overlay = document.getElementById("overlay");
let modalImageToChange = modalChangeImage.querySelector(".image-replace");
let newImageDiv = modalChangeImage.querySelector(".new-image-div");
let newImage = newImageDiv.querySelector(".new-image");
let btnInputImage = modalChangeImage.querySelector(".insertNewPhoto");
let btnChangeImage = modalChangeImage.querySelector(".change-image-btn");
let btnEditLevel = form.querySelector("#btn_edit_level")
let inputReplacedImages = form.querySelector("#images_replaced");

// variables
let imageChange = null;
let checkboxImage = null;
let userChangedImage = false;

// events
btnChangeImage.addEventListener("click", changeImage);
btnInputImage.addEventListener("change", insertNewPhoto)
overlay.addEventListener("click", removeModal);
btnOpenModal.forEach(element =>{

    element.addEventListener("click", openModal);

});

// functions
function openModal(e){
    imageChange = this.parentElement.querySelector(".level-image");
    checkboxImage = this.parentElement.querySelector(".image-checkbox");
    modalImageToChange.src = imageChange.src;
    overlay.style.display = "block";    
    modalChangeImage.style.display = "block";

}

function removeModal(){

    resetValues();
    overlay.style.display = "none";    
    modalChangeImage.style.display = "none";

}

function insertNewPhoto(e){
    var file = e.target.files[0];
    if (file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = displayNewImage;
        reader.readAsDataURL(file);
    }
        
}

function displayNewImage(e) {
    newImage.src = e.target.result;
    newImage.parentElement.style.display = "block";
    btnChangeImage.style.display = "block";
}

function changeImage(e){
    userChangedImage = true;
    e.preventDefault();
    imageChange.src = newImage.src;
    checkboxImage.checked = true;
    removeModal();
}

function resetValues(){
    if(userChangedImage === false){
        btnInputImage.value = "";
    }
    newImageDiv.style.display = "";
    newImage.src = "";
    btnChangeImage.style.display = "none";
}

