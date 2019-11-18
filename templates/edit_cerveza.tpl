<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <form method='POST' action='{$base}/cerveza/editar/{$cerveza->id_cerveza}' enctype="multipart/form-data">
        <fieldset>
            <legend>Cerveza ID:{$cerveza->id_cerveza}</legend>
            ID: <input type="text" value='{$cerveza->id_cerveza}' name="id_cerveza" readonly></br>
            Nombre: <input type="text" value='{$cerveza->nombre}' name="nombre"></br>
            Estilo: <select name="estilo">
                {foreach from=$estilos item=est}
                    <option value="{$est->nombre}">{$est->nombre}</option>
                {/foreach}
            </select></br>
            imagenes:
              {if !empty($cerveza->imagenes)}
                {foreach from=$cerveza->imagenes item=imagen}
                    <img src="{$base}/img/cervezas/{$imagen->archivo}" width=100><a href="{$base}/cerveza/eliminarImg/{$cerveza->id_cerveza}/{$imagen->archivo}"><-Eliminar</a>
                {/foreach}
              {else} No hay imágenes para mostrar</br>
              {/if}
              </br>
            Cargar Imagen(es): <input type="file" name="imagesToUpload[]" id="imagesToUpload" multiple></br>
            Amargor: <input type="number" value='{$cerveza->amargor}' name="amargor" min=0 max=300></br>
            Alcohol %: <input type="number" value='{$cerveza->alcohol}' name="alcohol" min=0 max=50></br>
            <input type="submit" value='Confirmar'></br>
        </fieldset>
    </form>
</body>
</html>