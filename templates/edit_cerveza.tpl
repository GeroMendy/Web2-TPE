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
    <div class="container-fluid">
        <div class="row border border-secondary bg-warning text-dark text-center">
            <div class="col-sm border border-secondary">
                ID
            </div>
            <div class="col-sm border border-secondary">
                Nombre
            </div>
            <div class="col-sm border border-secondary">
                Imagen
            </div>
            <div class="col-sm border border-secondary">
                Estilo
            </div>
            <div class="col-sm border border-secondary">
                Amargor en IBU
            </div>
            <div class="col-sm border border-secondary">
                Alcohol %
            </div>
        </div>
        <div class="row">
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->id_cerveza}  
            </div>
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->nombre}  
            </div>
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->imagen}
            </div>
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->Estilo}  
            </div>
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->amargor}  
            </div>
            <div class="col-sm border border-secondary text-center">
                    {$cerveza->alcohol}  
            </div>
        </div>
        <div class="row">
                <div class="col-sm border border-secondary text-center">
                        No Editable
                </div>
                <div class="col-sm border border-secondary text-center">
                        <form><input type="text" value='{$cerveza->nombre}'></form>
                </div>
                <div class="col-sm border border-secondary text-center">
                        <form><input type="text" value='{$cerveza->imagen}'></form>
                </div>
                <div class="col-sm border border-secondary text-center">
                         <form><select name="estilo">
                            {foreach from=$estilos item=est}
                                <option value="{$est->nombre}">{$est->nombre}</option>
                            {/foreach}
                        </select></form>
                </div>
                <div class="col-sm border border-secondary text-center">
                        <form><input type="number" value='{$cerveza->amargor}'></form>
                </div>
                <div class="col-sm border border-secondary text-center">
                        <form><input type="number" value='{$cerveza->alcohol}'></form>
                </div>
        </div>
        <form><input type="submit" value='Confirmar'></form>
    </div>
</body>
</html>