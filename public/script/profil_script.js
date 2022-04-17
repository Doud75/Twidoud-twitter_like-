var deconnection = document.querySelector("#deco_form");
var profilBtn = document.querySelector("#profil_btn");
var nav = document.querySelector("#nav");

nav.appendChild(deconnection);
nav.appendChild(profilBtn);

var change_profil_btn = document.querySelector("#open_change_profil");
var change_profil_form = document.querySelector("#change_profil");

let isVisible = false;
function change_profil_picture() {
    isVisible= !isVisible
    change_profil_btn.innerHTML = isVisible? "annuler" : "Modifier photo";
    change_profil_form.style.visibility = isVisible? "visible" : "hidden";
}

var change_pseudo_btn = document.querySelector("#open_change_pseudo");
var change_pseudo_form = document.querySelector("#change_pseudo_form");

let isVisiblePseudo = false;
function change_profil_pseudo() {
    isVisiblePseudo= !isVisiblePseudo
    change_pseudo_btn.innerHTML = isVisiblePseudo? "annuler" : "Modifier pseudo";
    change_pseudo_form.style.visibility = isVisiblePseudo? "visible" : "hidden";
}

change_profil_btn.addEventListener("click", change_profil_picture);
change_pseudo_btn.addEventListener("click", change_profil_pseudo);
