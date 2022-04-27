
position = localStorage.getItem("scroll");
window.scrollTo(0, position)
localStorage.setItem("scroll", 0);

var body = document.querySelector("body");
var new_tweet_form = document.querySelector("#newTweetForm");
var new_tweet_btn = document.querySelector(".newTweetBtn");
var new_tweet_input = document.querySelector("#tweet_input");
var new_image_input = document.querySelector("#fileToUpload");
var depose = document.querySelector("#depose");
var deconnection = document.querySelector("#deco_form");
var profilBtn = document.querySelector("#profil_form");
var nav = document.querySelector("#nav");

// j'ajoute des boutons à la nav bar
nav.appendChild(deconnection);
nav.appendChild(profilBtn);


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

// permet d'ouvrir le formulaire nouveau tweet ou de le vider si on le ferme
let isVisibleNewTweet = false;
function open_tweet_input() {
  isVisibleNewTweet = !isVisibleNewTweet
  new_tweet_btn.innerHTML = isVisibleNewTweet ? "annuler" : "Nouveau Tweet";
  new_tweet_form.style.visibility = isVisibleNewTweet ? "visible" : "hidden";
  body.style.backgroundColor = isVisibleNewTweet ? "#707070" : "";
  if (isVisibleNewTweet === false) {
    new_tweet_form.reset();
    var p=document.querySelector("#preview");
    p.innerHTML="";
    p.style.display="none";
  }
}

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

// affiche la mignature de l'image upload
function openVignette() {
  var p=document.querySelector("#preview");
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

new_tweet_btn.addEventListener("click", open_tweet_input);