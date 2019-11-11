<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>{$titulo}</title>
</head>
<body>
    <div class="container justify-content-center text-center">
        {if $logged}
            Bienvenido, {$user}</br>
            <a href="{$base}/logout">Cerrar sesión</a></br>
        {else}
            <form  action="{$base}/login" method="POST">
                Email Usuario: <input type="text" name="email">   Contraseña: <input type="password" name="password"></br>
                <input type="submit" value='Login'>       
            </form></br>
            <a href="{$base}/register">Agregar usuario</a></br>
        {/if}
        {if $admin}
            <a href="{$base}/userAdmin">Administrar usuarios</a>
        {/if}
    </div>

    <div class="container justify-content-center text-center">
    <h1>Página de cerveza</h1></br></br>
        <a href="{$base}/estilo/"><h2>Ver Estilos</h2></br>
            <img src="img/estilos.jpg" alt='Ver Estilos' width=600></a></br></br>
        <a href="{$base}/cerveza/">
            <h2>Ver Cervezas</h2></br>
            <img src="img/cervezas.jpg" alt='Ver cervezas' width=600></a>
    </div>
</body>
</html>