"use strict"

document.addEventListener("DOMContentLoaded",function(){

    console.log("Comentarios_cerveza.js Working...");

    let comentarios_vue = new Vue({
        el: "#vue-comentarios",
        data:{
            id_usuario_logged: -1,
            subtitulo: "comentarios",
            comentarios: [],
            adminLogged: false
        }
    });

    function getComentarios(id_cerveza){
        fetch("api/comentario/"+id_cerveza)
        .then(response => response.json())
        .then(comentarios => comentarios_vue.comentarios = comentarios)
        .catch(error => console.log(error));
    }

    let id_cerveza = document.querySelector("#id_cerveza_para_getComentarios").value;
    console.log("id_cerveza : "+id_cerveza);
    id_cerveza = Number(id_cerveza);
    
    getComentarios(id_cerveza);
});