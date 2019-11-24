"use strict";
let i=0;
let timer;
let x = document.getElementsByClassName("Slides");
for (let j = 0; j < x.length; j++) {
    x[j].addEventListener("click",pasar);
    esconderSlide(x[j]);
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
    img.removeClass(".js-mostrar");
    img.addClass(".js-ocultar");
}
function mostrarSlide(img){
    img.removeClass(".js-ocultar");
    img.addClass(".js-mostrar");
}

function pasar(){
    clearInterval(timer);
    carousel();
}
