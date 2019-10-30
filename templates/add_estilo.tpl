<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
</head>
<body>
    <form method='POST' action='{$base}/estilo/agregar'>
        Nombre del Estilo: <input type="text" value='' name="nombre"></br>
        Color: <input type="text" value='' name="color"></br>
        Aroma:<input type="text" value='' name="aroma"></br>
        Apariencia:<input type="text" value='' name="apariencia"></br>
        Sabor:<input type="text" value='' name="sabor"></br>
        Amargor Mínimo:<input type="number" value='' name="amin" min=0 max=300></br>
        Amargor Máximo:<input type="number" value='' name="amax" min=0 max=300></br>
        Alcohol Min %:<input type="number" value='' name="almin" min=0 max=50></br>
        Alcohol Max %:<input type="number" value='' name="almax" min=0 max=50></br>
        <input type="submit" value='Confirmar'>
    </form>
</body>
</html>