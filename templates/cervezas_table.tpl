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
    {if sizeof($cervezas) > 1}
        <a href="{$base}/cerveza/sorted/">Ordenar por Estilo</a></br>
    {/if}
    <form method='GET' action='{$base}/cerveza/filter/'>
        <input type="submit" value='Filtrar por estilo >'>
        <select name="estilo">
            {foreach from=$estilos item=est}
              <option value="{$est->nombre}">{$est->nombre}</option>
            {/foreach}
        </select>
        <a href='{$base}/cerveza'>Quitar Filtro</a>
    </form>

    {if $admin}
        <a href='{$base}/cerveza/agregar'>Agregar Cerveza</a></br>
    {/if}
     <a href='{$base}'>HOME</a>
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
                        {if $cer->imagen neq ""}
                            <img src="{$base}/img/cervezas/{$cer->imagen}" height="60">
                        {/if}
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
                        <a href ="{$base}/cerveza/{$cer->id_cerveza}">VER</a></br>
                        {if $admin}
                            <a href="{$base}/cerveza/editar/{$cer->id_cerveza}">EDITAR</a></br>
                            <a href="{$base}/cerveza/eliminar/{$cer->id_cerveza}">ELIMINAR</a></br>
                        {/if}
                    </div>
                </div>
            {/foreach}
</body>
</html>