<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$titulo}</title>
        <link rel="stylesheet" href="{$base}/css/cerveza_unica.css">
        <!-- development version, includes helpful console warnings -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body>
        <a href='{$base}'>HOME</a></br>
        <a href='{$base}/cerveza'>Lista Cervezas</a>
        <fieldset>
            <legend><h1>{$cerveza->nombre}</h1></legend>
            <h2>Imagenes: </h2>
            {if !empty($cerveza->imagenes)}
                <div>
                    {foreach from=$cerveza->imagenes item=imagen}
<<<<<<< HEAD
                            <img class="Slides js-ocultar" src="{$base}/img/cervezas/{$imagen->archivo}" width="400">
=======
                            <img class="Slides hidden" src="{$base}/img/cervezas/{$imagen->archivo}" width="400">
>>>>>>> hardcodeandoEliminar
                    {/foreach}
                </div>
            {else} No hay imágenes para mostrar
            {/if}
            </br>
            <h2>Estilo: {$cerveza->Estilo}</h2>
            <h2>Alcohol:  {$cerveza->alcohol}%</h2>
            <h2>Amargor: {$cerveza->amargor} IBU</h2>
            <h2 class="js_valoracion"></h2>
        </fieldset></br>
        {if $logged}
            <fieldset>
                <legend><h2>Comentar</h2></legend>                
                    <form id="commentform">
                        Comentario:</br> <textarea id="agregar_comentario_texto" name="texto" form="commentform" cols="60" rows="8" placeholder="Comenta aquí, 500 caracteres máximo" maxlength="500"></textarea></br>
                        Valoracion: <input type="number" value="3" name="valoracion" min=1 max=5></br>
                        <input type="submit" value='Publicar'>
                    </form>
            </fieldset>
        {/if}
        <fieldset>
           <legend><h1>Comentarios</h1></legend>

            {include file="vue/comentarios_cerveza.tpl"}

            <input class="js-ocultar" id="js_logged" value={$logged}>
            <input class="js-ocultar" id="js_admin" value={$admin}> 

        </fieldset>
    </body>
    <script src="{$base}/js/carousel_img_cerveza.js"></script>
    <script src="{$base}/js/comentarios_cerveza.js"></script>
</html>