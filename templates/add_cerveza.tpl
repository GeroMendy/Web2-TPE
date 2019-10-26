<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
</head>
<body>
    <form>
        <input type="text" value='Nombre'>
        <input type="text" value='Imagen'>
        <select name="estilo">
            {foreach from=$estilos item=est}
                <option value="{$est->nombre}">{$est->nombre}</option>
            {/foreach}
        </select>
        <input type="number" value='{$cerveza->amargor}'>
        <input type="number" value='{$cerveza->alcohol}'>
        <input type="submit" value='Confirmar'>
    </form>
</body>
</html>