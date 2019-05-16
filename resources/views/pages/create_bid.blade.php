<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Añadir Artículos</title>

    </head>
    <body>
        <form method="get" action="bids/addbid" class="additem">
            <select type=select name="item" placeholder="Artículo">
            <?php
                foreach ($items as $item) {
                    echo ("<option value=\"".$item->nombre."\">".$item->nombre."</option>");
                }
            ?>
            </select>
            <input type=number name="price" placeholder="Precio Inicial">
            <input type=number name="days" placeholder="Segundos Activo">
            <input type=submit value="submit">
        </form>
    </body>
</html>