<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
</head>
<body>
    <form method='POST' action=''>
        Nombre de Cerveza: <input type="text" name="nombre"></br>
        Nombre Archivo imagen: <input type="text" value='' name="imagen"></br>
        Estilo: <select name="estilo">
            {foreach from=$estilos item=est}
                <option value="{$est->nombre}">{$est->nombre}</option>
            {/foreach}
        </select></br>
        Amargor: <input type="number" name="amargor" min=0 max=300></br>
        Alcohol %: <input type="number" value='0' name="alcohol" min=0 max=50></br>
        <input type="submit" value='Confirmar'>
    </form>
</body>
</html>