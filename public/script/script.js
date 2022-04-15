var new_tweet_form = document.querySelector("#newTweetForm");
var new_tweet_btn = document.querySelector(".newTweetBtn");
var new_tweet_input = document.querySelector("#tweet_input");
var new_image_input = document.querySelector("#fileToUpload");
var depose = document.querySelector("#depose");
var deconnection = document.querySelector("#deco_form");
var nav = document.querySelector("#nav");

nav.appendChild(deconnection);


let modify_tweet_btn = document.querySelectorAll("#btn_modify");
modify_tweet_btn.forEach(button => {
  let isVisible = false

  button.addEventListener("click", e => {
    const target = e.target
    const toDisplay = target.nextElementSibling
    isVisible = !isVisible
    target.innerHTML = isVisible ?  "annuler" : "modifier";
    toDisplay.style.visibility = isVisible ? "visible" : "hidden";
  })
})

let isVisibleNewTweet = false;
function open_tweet_input() {
  isVisibleNewTweet = !isVisibleNewTweet
  new_tweet_btn.innerHTML = isVisibleNewTweet ? "annuler" : "Nouveau Tweet";
  new_tweet_form.style.visibility = isVisibleNewTweet ? "visible" : "hidden";
  if (isVisibleNewTweet === false) {
    new_tweet_form.reset();
    var p=document.querySelector("#preview");
    p.innerHTML="";
    p.style.display="none";
  }
}

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





