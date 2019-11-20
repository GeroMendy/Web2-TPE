<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$titulo}</title>
        <!-- development version, includes helpful console warnings -->
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    </head>
    <body>
        <a href='{$base}'>HOME</a></br>
        <a href='{$base}/cerveza'>Lista Cervezas</a>
        <fieldset>
            <legend><h1>{$cerveza->nombre}</h1></legend>
            <img src='{$base}/{$cerveza->imagen}' width="420">
            <h2>Estilo: {$cerveza->Estilo}</h2>
            <h2>Alcohol:  {$cerveza->alcohol}%</h2>
            <h2>Amargor: {$cerveza->amargor} IBU</h2>
        </fieldset></br>
        {if $id_logged!=-1}
            <fieldset>
                <legend><h2>Comentar</h2></legend>
            
            </fieldset>
        {/if}
        <fieldset>
           <legend><h3>Comentarios</h3></legend>

            {{include file="templates/vue/comentarios_cerveza.tpl"}}

            <input class="hidden" id="id_logged" style="visibility:hidden" value={$id_logged}>
            <input class="hidden" id="isAdmin" style="visibility:hidden" value={$admin}> 

        </fieldset>
    </body>
    <script src="../js/comentarios_cerveza.js"></script>
</html>