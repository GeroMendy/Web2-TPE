"use strict"
let comentarios_vue = new Vue({
    el: "#vue-comentarios",
    data:{
        subtitulo:"comentarios",
        comentarios:[],
        adminLogged:false,
        id_usuario_logged:-1
    }
});

function getComentarios(id_cerveza){    //No se de donde obtener id_cerveza.
    fetch("api/comentarios/"+id_cerveza)
    .then(response => response.json())
    .then(comentarios_vue.comentarios = comentarios)
    .catch(er => console.log(er));
}