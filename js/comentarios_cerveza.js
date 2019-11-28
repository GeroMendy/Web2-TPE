"use strict"

document.addEventListener("DOMContentLoaded",function(){

    let intervalEliminar;

    let form_comentario = document.querySelector("#commentform");
    if(form_comentario !=null){
        form_comentario.addEventListener("submit",postComentario);
    }

    document.querySelector("#agregar_comentario_texto").addEventListener("click",easterEgg);

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
            esperarParaComentarios();
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
            document.querySelector(".js_valoracion").innerHTML="Valoración promedio: "+(Math.round(promedio*100)/100)+" / 5";
            if (isAdmin())
                intervalEliminar = setTimeout(funtion =>{linkearAnchorsEliminarComentario(comentarios)},200);//genero un bucle porque los button no estan generados.
        })
        .catch(error => console.log(error));
        comentarios_vue.adminLogged = isAdmin();
        comentarios_vue.id_usuario_logged = getIdLogged();
    }

    function linkearAnchorsEliminarComentario(com){
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

    async function eliminarComentario(id_com){
        console.log("Eliminando comentario "+id_com);
        let urlBorrar=getUrlEliminar(id_com);
        let tit_anterior=document.title;
        document.title="Borrando...";
        try{
            let prom=await fetch(urlBorrar,{"method":"DELETE"})
            if (prom.ok){
                getComentarios();
                console.log("Borrado");
            }
        }
        catch(error){console.log(error);}
        document.title=tit_anterior;
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
    function getUrlEliminar(id_com){
        let replaced = "cerveza";
        let url = window.location.pathname;
        let inicio = url.lastIndexOf(replaced);
        let newPath = "api/comentario/eliminar";
        return url.substring(0,inicio) + newPath + id_com;
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
    
    let activado=false;
    function easterEgg(){
        let text=document.querySelector("#agregar_comentario_texto").value;
        if (text==="juan codigo"){
            if (!activado){
                let imgs=document.getElementsByTagName("img");
                for (let i =0; i<imgs.length;i++){
                    let source= imgs[i].src;
                    imgs[i].src=source.substring(0,source.lastIndexOf("cervezas"))+"juancodigo.jpg";
                }
                activado=true;
            }
            hackerman();
        }
    }
    function hackerman(){
        let html=document.getElementsByTagName("body");
        html[0].classList.toggle("hackerman");
    }
});