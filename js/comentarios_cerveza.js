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
            comentarios: [],
            usuario_logged: 0,
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
            console.log("Comentario Agregado Correctamente.");
            getComentarios();
        })
        .catch(error=>console.log(error));
    }

    function getComentarios(){
        fetch( getUrlgetComentarios() )
        .then(response => response.json())
        .then(comentarios => {
            comentarios_vue.comentarios = comentarios;
            let valoracionTotal = 0;
            let promedio;
            comentarios.forEach(com => {
                valoracionTotal += Number.parseInt(com.valoracion);
            });
            if (comentarios.length!=0)
                promedio = (valoracionTotal/comentarios.length);
            else promedio =0;
            document.querySelector(".js_valoracion").innerHTML="Valoración promedio: "+Math.round(promedio);
            if (isAdmin())
                setTimeout(funtion =>{linkearBotonesEliminarComentario(comentarios)},200);//Espero a que se generen los botones eliminar.
        })
        .catch(error => console.log(error));
        comentarios_vue.adminLogged = isAdmin();
        comentarios_vue.id_usuario_logged = getLogged();
    }

    function linkearBotonesEliminarComentario(com){
        let anchors_eliminar=document.querySelectorAll(".js_eliminar_comentario");
        while (anchors_eliminar.length!=com.length){
            anchors_eliminar=document.querySelectorAll(".js_eliminar_comentario");
        }
        for (let i = 0; i< anchors_eliminar.length; i++){
            anchors_eliminar[i].addEventListener("click",function(){
                eliminarComentario(com[i].id_comentario);
            },{once:true});
        }
    }

    function eliminarComentario(id_com){    
        console.log("Eliminando comentario "+id_com);
        let urlBorrar=getUrlEliminar(id_com);
        let paquete_delete = {
            "method":"DELETE",
        };

        let tit_anterior=document.title;
        document.title="Borrando...";
        try{
            fetch(urlBorrar,paquete_delete)
            .then(r=>{
                console.log("Eliminado Comentario "+id_com);
                getComentarios();
            });
        }
        catch(error){console.log(error);}
        document.title=tit_anterior;
    }
    
    function isAdmin(){
        let input = document.querySelector("#js_admin");
        if(input!=null){
            return input.value;
        }else{
            return false;
        }
    }
    function getLogged(){
        let input = document.querySelector("#js_logged");
        if(input!=null){
            return input.value;
        }else{
            return false;
        }
    }

    function getUrlgetComentarios(){
        let replaced = "cerveza";
        let newPath = "api/comentario";
        return replaceUrl(replaced,newPath);
    }
    function getUrlEliminar(id_com){
        let deleted = "cerveza";
        let newPath = "api/comentario/eliminar/";
        let url = deleteSubtringURL(deleted);

        return url + newPath + id_com;
    }
    function getUrlAddComentario(){
        let replaced = "cerveza";
        let newPath = "api/comentario/agregar";
        return replaceUrl(replaced,newPath);
    }
    function deleteSubtringURL(deleted){    //Busca la ultima coincidencia y elimina todo desde ahi.
        let url = window.location.pathname;
        let position = url.lastIndexOf(deleted);
        return url.substring(0,position);
    }
    function replaceUrl(replaced,newPath){  //Busca la ultima coincidencia y la reemplaza, manteniendo el substring posterior.
        let url = window.location.pathname;
        let inicio = url.lastIndexOf(replaced);
        let fin = inicio + replaced.length;
        url = url.substring(0,inicio) + newPath + url.substring(fin,url.length);
        return url;
    }
    
    getComentarios();
});