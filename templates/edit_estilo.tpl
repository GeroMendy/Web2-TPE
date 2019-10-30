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
    <form method='POST' action='{$base}/editar/estilo/{$estilo->id_estilo}'>
        <fieldset>
            <legend>Estilo ID:{$estilo->id_estilo}</legend>
            ID: <input type="text" value='{$estilo->id_estilo}' name="id_estilo" readonly></br>
            Nombre: <input type="text" value='{$estilo->nombre}' name="nombre"></br>
            Color: <input type="text" value='{$estilo->color}' name="color"></br>
            Aroma: <input type="text" value='{$estilo->aroma}' name="aroma"></br>
            Apariencia: <input type="text" value='{$estilo->apariencia}' name="apariencia"></br>
            Sabor: <input type="text" value='{$estilo->sabor}' name="sabor"></br>
            Amargor Mínimo: <input type="number" value='{$estilo->amargor_min}' name="amargor_min" min=0 max=300></br>
            Amargor Máximo: <input type="number" value='{$estilo->amargor_max}' name="amargor_max" min=0 max=300></br>
            Alcohol Mínimo: <input type="number" value='{$estilo->alcohol_min}' name="alcohol_min" min=0 max=50></br>
            Alcohol Máximo: <input type="number" value='{$estilo->alcohol_max}' name="alcohol_max" min=0 max=50></br>
            <input type="submit" value='Confirmar'>
        </fieldset>
    </form>
</body>
</html>