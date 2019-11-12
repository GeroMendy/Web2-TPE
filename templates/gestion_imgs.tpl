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
        <fieldset>
                <legend><h2>Imágenes cargadas</h2></legend>
                {foreach from=$archivos item=img}
                    <img src="{$base}/{$directorio}/{$img}" width="100"><a href="{$base}/deleteImg/{$id}/{$img}">Eliminar</a></br>
                {/foreach}    
        </fieldset></br>
        Subir Imagen(es):
        <form action="{$base}/subirImg/{$id}" method="POST" enctype="multipart/form-data">
            <input type="file" id="imagenes" name="imagenes[]" multiple>
            <input type="submit" value='Subir'>
        </form>

    </body>
</html>