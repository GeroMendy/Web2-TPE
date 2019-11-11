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
                Mail
            </div>
            <div class="col-sm border border-secondary">
                Admin
            </div>
            <div class="col-sm border border-secondary">
                Acciones
           </div>
        </div>
            {foreach from=$usuarios item=user}
                <div class="row">
                    <div class="col-sm border border-secondary text-center">
                        {$user->id_usuario}  
                    </div>
                    <div class="col-sm border border-secondary text-center">
                        {$user->nombre}  
                    </div>
                    <div class="col-sm border border-secondary text-center">
                        {$user->mail}  
                    </div>
                    {if $user->admin eq 1}
                        <div class="col-sm border border-secondary text-center">
                            SI
                        </div>
                    {else}
                        <div class="col-sm border border-secondary text-center">
                            NO
                        </div>
                    {/if}
                    <div class="col-sm border border-secondary text-center">
                            <a href="{$base}/usuario/eliminar/{$user->id_usuario}">Eliminar</a></br>
                            <a href="{$base}/usuario/toggleAdmin/{$user->id_usuario}">Toggle Admin</a>
                    </div>
                </div>
            {/foreach}
    </div>
</body>
</html>