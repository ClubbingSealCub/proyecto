<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $fields[0]->name }}</title>

    </head>
    <body>
        <h1>{{ $fields[0]->name }} ({{ $fields[0]->email }})</h1>
        <?php
            if($fields[0]->id == $current_id) {
                echo("<p>(Eres tú!)</p>");
            }
        ?>

        <?php
            if(count($items) == 0) {
                if($fields[0]->id === $current_id){
                    echo("<p>Todavía no tienes artículos</p>");
                } else {
                    echo("<p>".$fields[0].name." todavía no tiene artículos.</p>");
                }
            } else {
                if($fields[0]->id === $current_id){
                    echo("<p>Tus Artículos</p>");
                } else {
                    echo("<p>Los Artículos de ".$fields[0]->name."</p>");
                }
            }
        ?>

        <?php
            if(count($items) == 0) {
                if($fields[0]->id === $current_id){
                    echo("<p>Todavía no tienes artículos en subasta.</p>");
                } else {
                    echo("<p>".$fields[0].name." todavía no tiene artículos en subasta.</p>");
                }
            } else {
                if($fields[0]->id === $current_id) {
                    echo("<p>Tus Artículos en subasta</p>");
                } else {
                    echo ("<p>Los Artículos en subasta de ".$fields[0]->name."</p>");
                }
                echo("<ul style='width:50%'>");
                foreach ($items as $item) {
                    echo("<li>".$item->nombre." - Precio actual: ".$item->precio."€ - Finaliza: ".$item->ends_at."</li>");
                }
                echo("</ul>");
            }
        ?>
        <a href="{{ url('additem') }}">Crear subasta</a>
    </body>
</html>
