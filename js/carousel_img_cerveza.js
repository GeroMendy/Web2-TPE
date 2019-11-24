"use strict";
let i=0;
let timer;
let x = document.getElementsByClassName("Slides");
for (let j = 0; j < x.length; j++) {
    x[j].addEventListener("click",pasar);
}

if (x.length>1) timer=setInterval(carousel, 3000);
if (x.length>=1) mostrarSlide(x[i]);

function carousel() {
    esconderSlide(x[i]);
    i++;
    if (i>=x.length) i=0;
    mostrarSlide(x[i]);
}

function esconderSlide(img){
    img.classList.remove("visible");
    img.classList.add("hidden");
}
function mostrarSlide(img){
    img.classList.remove("hidden");
    img.classList.add("visible");
}

function pasar(){
    clearInterval(timer);
    carousel();
}
