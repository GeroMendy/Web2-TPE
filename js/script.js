"use strict";
let i=0;
let timer;
let x = document.getElementsByClassName("Slides");
for (let j = 0; j < x.length; j++) {
    x[j].addEventListener("click",pasar); 
}

if (x.length>1) timer=setInterval(carousel, 3000);
if (x.length>=1) x[i].style.display="block";

function carousel() {
    x[i].style.display = "none";
    i++;
    if (i>=x.length) i=0;
    x[i].style.display="block";
}

function pasar(){
    clearInterval(timer);
    carousel();
}