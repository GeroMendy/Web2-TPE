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
            console.log(p);
            
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
        comentarios_vue.id_usuario_logged = getIdLogged();
    }

    function linkearBotonesEliminarComentario(com){
        let anchors_eliminar=document.querySelectorAll(".js_eliminar_comentario");
        while (anchors_eliminar.length!=com.length){
            anchors_eliminar=document.querySelectorAll(".js_eliminar_comentario");
        }
        for (let i = 0; i< anchors_eliminar.length; i++){
            anchors_eliminar[i].addEventListener("click",function(){
                eliminarComentario(com[i].id_comentario);
            });
        }
    }

    function eliminarComentario(id_com){
        console.log(id_com);
        console.log("Eliminando comentario "+id_com);
        let urlBorrar="api/comentario/eliminar/"+id_com;
        let paquete_delete = {
            "method":"GET",
            "mode":"cors",
            "headers":{"Content-type":"application/json"}
        };

        let tit_anterior=document.title;
        document.title="Borrando...";
        try{
            fetch(urlBorrar,paquete_delete)
            .then(r=>console.log(r));
        }
        catch(error){console.log(error);}
        document.title=tit_anterior;
    }
    
    async function borrar(id_delete){
        let urlborrar=url+"/"+id_delete;
        document.title="Borrando...";
        try{let prom=await fetch(urlborrar,{"method":'DELETE'})
        }
        catch(error){console.log(error);}
        document.title="Catalogo de Cervezas";
        mostrartabla();
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
    function esperarParaComentarios(){
        setTimeout(getComentarios(),300);
    }
    getComentarios();
});