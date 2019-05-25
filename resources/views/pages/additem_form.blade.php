<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Añadir Artículos</title>

    </head>
    <body>
        <form method="get" action="items/additem" class="additem">
            <input type=text name="item" placeholder="Artículo">
            <input type=textarea name="desc" placeholder="Descripción">
            <select type=select name="family" placeholder="Familia">
            <?php
            foreach ($families as $family) {
                echo ("<option value=\"".$family."\">".$family."</option>");
            }
            ?>
            </select>
            <input type=number name="price" placeholder="Precio">
            <input type=number name="time" placeholder="Tiempo Activo (minutos)">
            <input type=submit value="submit">
        </form>
    </body>
</html>