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
   <h1>Página de cerveza</h1></br></br>
    <form  action="{$base}/estilo/" method="GET">
        <h2>Ver Estilos</h2></br>
        <input type="image" src="img/estilos.jpg" alt="Submit Form" width=500></br></br>
    </form>
    
    <form  action="{$base}/cerveza/" method="GET">
        <h2>Ver Cervezas</h2></br>
        <input type="image" src="img/cervezas.jpg" alt="Submit Form" width=500></br>
    </form>
</div>
</body>
</html>