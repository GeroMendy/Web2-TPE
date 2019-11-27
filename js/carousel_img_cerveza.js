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
    img.classList.remove("js-mostrar");
    img.classList.add("js-ocultar");
}
function mostrarSlide(img){
    img.classList.remove("js-ocultar");
    img.classList.add("js-mostrar");
}

function pasar(){
    clearInterval(timer);
    carousel();
}
