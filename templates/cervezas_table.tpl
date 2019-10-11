<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$titulo}</title>
</head>
<body>

    <table>
        {foreach from=$cervezas item=cer}
        <tr>
            {foreach from=$cer item=carac}
            <td>
                {$carac}
            </td>
            {/foreach}
        </tr>
        {/foreach}
    </table>
    
</body>
</html>