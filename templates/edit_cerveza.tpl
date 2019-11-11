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
            Imagen: <input type="file" name="input_img" id="imageToUpload"></br>
            Imágenes subidas: <select name="imagen-preloaded">
                                {foreach from=$imagenes item=img}
                                    <option value={$img}>{$img}</option>
                                {/foreach}
                              </select></br>
            <input type="checkbox" name="sinImagen" id="noimage"><label for="noimage"> Sin Imagen </label></br>
            Estilo: <select name="estilo">
                {foreach from=$estilos item=est}
                    <option value="{$est->nombre}">{$est->nombre}</option>
                {/foreach}
            </select></br>
            Amargor: <input type="number" value='{$cerveza->amargor}' name="amargor" min=0 max=300></br>
            Alcohol %: <input type="number" value='{$cerveza->alcohol}' name="alcohol" min=0 max=50></br>
            <input type="submit" value='Confirmar'>
        </fieldset>
    </form>
</body>
</html>