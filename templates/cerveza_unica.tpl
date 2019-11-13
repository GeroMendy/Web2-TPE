<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{$titulo}</title>
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
        {if $logged}
            <fieldset>
                <legend><h2>Comentar</h2></legend>
            
            </fieldset>
        {/if}
        <fieldset>
            <legend><h3>Comentarios</h3></legend>
            Si es admin agregar eliminar

            {{include file="templates/vue/comentarios_cerveza.tpl"}}

        </fieldset>
    </body>
</html>