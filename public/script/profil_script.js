position = localStorage.getItem("scroll");
window.scrollTo(0, position)
localStorage.setItem("scroll", 0);

var deconnection = document.querySelector("#deco_form");
var profilBtn = document.querySelector("#profil_form");
var nav = document.querySelector("#nav");
var body = document.querySelector("body");
var pseudo_positions = document.querySelector("#profil_pseudo");

// ajoute des éléments à la nav bar
nav.appendChild(deconnection);
nav.appendChild(profilBtn);

// place le pseudo au centre sous la photo de profil
let calcule_pseudo = 163 - (pseudo_positions.offsetWidth / 2);
pseudo_positions.style.left = calcule_pseudo + "px";

var change_profil_btn = document.querySelector("#open_change_profil");
var change_profil_form = document.querySelector("#change_profil");

// place le bouton changer image profil au centre sous la photo de profil
let calcule_profil_btn = 163 - (change_profil_btn.offsetWidth / 2);
change_profil_btn.style.left = calcule_profil_btn + "px";

// ouvre ou ferme le formulaire de changement de photo de profil
let isVisible = false;
function change_profil_picture() {
  isVisible= !isVisible
  change_profil_btn.innerHTML = isVisible? "annuler" : "Modifier photo";
  change_profil_form.style.visibility = isVisible? "visible" : "hidden";
  body.style.backgroundColor = isVisible ? "#707070" : "";
  let calcule_profil_btn = 163 - (change_profil_btn.offsetWidth / 2);
  change_profil_btn.style.left = calcule_profil_btn + "px";
  if (isVisible === false) {
      change_profil_form.reset();
      var p=document.querySelector("#preview_profil");
      p.innerHTML="";
      p.style.display="none";
  }
}

var change_pseudo_btn = document.querySelector("#open_change_pseudo");
var change_pseudo_form = document.querySelector("#change_pseudo_form");

// place le bouton changer de pseudo au centre sous la photo de profil
let calcule_pseudo_btn = 163 - (change_pseudo_btn.offsetWidth / 2);
change_pseudo_btn.style.left = calcule_pseudo_btn + "px";

var pseudo_input = document.querySelector("#change_pseudo");

// place l'input changer de pseudo au centre sous la photo de profil
let calcule_pseudo_input = 163 - (pseudo_input.offsetWidth / 2);
pseudo_input.style.left = calcule_pseudo_input + "px";

var pseudo_validate = document.querySelector("#valider_pseudo");

// place le bouton valider pseudo au centre sous la photo de profil
let calcule_pseudo_validate = 163 - (pseudo_validate.offsetWidth / 2);
pseudo_validate.style.left = calcule_pseudo_validate + "px";

// ouvre ou ferme le formulaire pour changer de pseudo
let isVisiblePseudo = false;
function change_profil_pseudo() {
  isVisiblePseudo= !isVisiblePseudo
  change_pseudo_btn.innerHTML = isVisiblePseudo? "annuler" : "Modifier pseudo";
  change_pseudo_form.style.visibility = isVisiblePseudo? "visible" : "hidden";
  body.style.backgroundColor = isVisiblePseudo ? "#707070" : "";
  calcule_pseudo_btn = 163 - (change_pseudo_btn.offsetWidth / 2);
  change_pseudo_btn.style.left = calcule_pseudo_btn + "px";
  if (isVisiblePseudo === false) {
      change_pseudo_form.reset();
  }
}


change_profil_btn.addEventListener("click", change_profil_picture);
change_pseudo_btn.addEventListener("click", change_profil_pseudo);

var depose = document.querySelector("#depose_profil");
var new_image_input = document.querySelector("#pictureToUpload");

// drag n drop
depose.addEventListener("click", function(evt) {
  evt.preventDefault();
  new_image_input.click();
  new_image_input.addEventListener("change", openVignette);
});

depose.addEventListener("dragover", function(evt) {
  evt.preventDefault();
});
depose.addEventListener("dragenter", function() {
  this.className="onDropZone";
});
depose.addEventListener("dragleave", function() {
  this.className="";
}); 
depose.addEventListener("drop", function(evt) {
  evt.preventDefault();
  new_image_input.files=evt.dataTransfer.files;
  this.className="";
  openVignette()
});
  
// affiche la mignature de la photo upload
function openVignette() {
  var p=document.querySelector("#preview_profil");
  p.innerHTML="";
  for (var i=0; i<new_image_input.files.length; i++) {
    var f=new_image_input.files[i];
    var div=document.createElement("div");
    div.className="fichier";
    var vignette=document.createElement("img");
    vignette.src = window.URL.createObjectURL(f);
    div.appendChild(vignette);
    p.appendChild(div);
  }
  p.style.display="block"; 
};

// je récupère tous les boutons modifier pour pouvoir ouvrir les formulaire que je veux
let modify_tweet_btn = document.querySelectorAll("#pen");
modify_tweet_btn.forEach(button => {
  let isVisible = false

  button.addEventListener("click", e => {
    const target = e.target
    const toDisplay = target.nextElementSibling
    isVisible = !isVisible
    toDisplay.style.visibility = isVisible ? "visible" : "hidden";
    body.style.backgroundColor = isVisible ? "#707070" : "";
  })
})

let like_btn = document.querySelectorAll("#like");
like_btn.forEach(button => {
  button.addEventListener("click", e => {
    position = window.scrollY;
    localStorage.setItem("scroll", position);
  })
})

let delete_btn = document.querySelectorAll(".delete");
delete_btn.forEach(button => {
  button.addEventListener("click", e => {
    position = window.scrollY;
    localStorage.setItem("scroll", position);
  })
})
