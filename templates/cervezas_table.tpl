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
    {if sizeof($cervezas) ne 1}
        <form  action="{$base}/cerveza/sorted/" method="GET"><input type="submit" value='Ordenar por estilo'></form>
    {/if}
    {if $admin}
        <form  action="{$base}/cerveza/agregar/" method="GET"><input type="submit" value='Agregar Cerveza'></form>
    {/if}
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
            <div class="col-sm border border-secondary">
                Acciones
            </div>
        </div>
            {foreach from=$cervezas item=cer}
            <div class="row">
                <div class="col-sm border border-secondary text-center">
                      {$cer->id_cerveza}  
                </div>
                <div class="col-sm border border-secondary text-center">
                      {$cer->nombre}  
                </div>
                <div class="col-sm border border-secondary text-center">
                      <img src='{$base}/img/{$cer->imagen}' width="42">
                </div>
                <div class="col-sm border border-secondary text-center">
                      {$cer->Estilo}  
                </div>
                <div class="col-sm border border-secondary text-center">
                      {$cer->amargor}  
                </div>
                <div class="col-sm border border-secondary text-center">
                      {$cer->alcohol}  
                </div>
                <div class="col-sm border border-secondary text-center">
                        <form  action="{$base}/cerveza/{$cer->id_cerveza}" method="GET"><input type="submit" value='Ver'></form>
                        {if $admin}
                        <form  action="{$base}/cerveza/editar/{$cer->id_cerveza}" method="GET"><input type="submit" value='Editar'></form>
                        <form  action="{$base}/cerveza/eliminar/{$cer->id_cerveza}" method="GET"><input type="submit" value='Eliminar'></form>
                        {/if}
                </div>
            </div>
            {/foreach}
</body>
</html>