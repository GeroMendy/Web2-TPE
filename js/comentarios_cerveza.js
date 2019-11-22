"use strict"

document.addEventListener("DOMContentLoaded",function(){

    console.log("Comentarios_cerveza.js Working...");

    let form_comentario = document.querySelector("#commentform");
    if(form_comentario !=null){
        form_comentario.addEventListener("submit",postComentario);
    }

    let comentarios_vue = new Vue({
        el: "#vue-comentarios",
        data:{
            id_usuario_logged: '',
            comentarios: [],
            url_eliminar: '',
            adminLogged: 0,
            promedio: 0
        }
    });

    function postComentario(e){
        e.preventDefault();
        
        let valoracion = form_comentario.getElementsByTagName("input").namedItem("valoracion").value;
        let texto = document.querySelector("#agregar_comentario_texto").value;

        let json = {
            "texto":texto,
            "valoracion":valoracion
        };
        let paquete_post={
            "method":"POST",
            "mode":"cors",
            "headers":{"Content-type":"application/json"},
            "body": JSON.stringify(json)
        };

        fetch(getUrlAddComentario(),paquete_post)
        .then(p=>{
            setInterval(getComentarios(),300);
            })
        .catch(error=>console.log(error))

    }

    function getComentarios(){
        fetch( getUrlgetComentarios() )
        .then(response => response.json())
        .then(comentarios => {
            comentarios_vue.comentarios = comentarios;
            let valoracionTotal = 0;
            comentarios.forEach(com => {
                valoracionTotal += Number.parseInt(com.valoracion);
            });
            console.log(valoracionTotal+" / "+comentarios.length+" = "+valoracionTotal/comentarios.length);
            
            comentarios_vue.promedio = (valoracionTotal/comentarios.length);
        })
        .catch(error => console.log(error));
        comentarios_vue.adminLogged = isAdmin();
        comentarios_vue.id_usuario_logged = getIdLogged();
        comentarios_vue.url_eliminar = getUrlEliminar();
    }

    function isAdmin(){
        let input = document.querySelector("#isAdmin");
        if(input!=null){
            return input.value;
        }else{
            return false;
        }
    }
    function getIdLogged(){
        let input = document.querySelector("#id_logged");
        if(input!=null){
            return input.value;
        }else{
            return -1;
        }
    }

    function getUrlgetComentarios(){
        let replaced = "cerveza";
        let newPath = "api/comentario";
        return replaceUrl(replaced,newPath);
    }
    function getUrlEliminar(){
        let replaced = "cerveza";
        let newPath = "api/comentario/eliminar";
        return replaceUrl(replaced,newPath);
    }
    function getUrlAddComentario(){
        let replaced = "cerveza";
        let newPath = "api/comentario/agregar";
        return replaceUrl(replaced,newPath);
    }
    function replaceUrl(replaced,newPath){
        let url = window.location.pathname;
        let inicio = url.lastIndexOf(replaced);
        let fin = inicio + replaced.length;
        url = url.substring(0,inicio) + newPath + url.substring(fin,url.length);
        return url;
    }

    getComentarios();
});