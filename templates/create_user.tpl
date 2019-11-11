<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
</head>
<body>
    <form method='POST' action='{$base}/register'>
        Nombre de Usuario: <input type="text" name="nombre"></br>
        Contraseña: <input type="password" name="password"></br>
        Email: <input type="text" name="email"></br>
        <input type="submit" value='Agregar usuario'>
    </form>
</body>
</html>