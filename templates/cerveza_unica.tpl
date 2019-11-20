<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$titulo}</title>
        <link rel="stylesheet" href="{$base}/css/estilo.css">
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
                            <img class="Slides" src="{$base}/img/cervezas/{$imagen->archivo}" width="400">
                    {/foreach}
                </div>
            {else} No hay imágenes para mostrar
            {/if}
            </br>
            <h2>Estilo: {$cerveza->Estilo}</h2>
            <h2>Alcohol:  {$cerveza->alcohol}%</h2>
            <h2>Amargor: {$cerveza->amargor} IBU</h2>
        </fieldset></br>
        {if $id_logged!=-1}
            <fieldset>
                <legend><h3>Comentar</h3></legend>
                <form method='POST' action='{$base}/cerveza/comentar' id="commentform">
                    Comentario:</br> <textarea name="comment" form="commentform" cols="60" rows="4" placeholder="Comenta aquí, 255 caracteres máximo" maxlength="255"></textarea></br>
                    Puntaje: <input type="number" value="3" name="puntaje" min=0 max=5></br>
                    <input type="submit" value='Publicar'>
                </form>
            </fieldset>
        {/if}
        <fieldset>
           <legend><h3>Comentarios</h3></legend>

            {{include file="templates/vue/comentarios_cerveza.tpl"}}

            <input class="hidden" id="id_logged" style="visibility:hidden" value={$id_logged}>
            <input class="hidden" id="isAdmin" style="visibility:hidden" value={$admin}> 

        </fieldset>
        <script src="{$base}/js/script.js"></script>
    </body>
    <script src="../js/comentarios_cerveza.js"></script>
</html>