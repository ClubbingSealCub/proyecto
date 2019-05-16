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
        <ul style="width:50%">
            <?php
            foreach ($items as $item) {
                echo ("<li>".$item->nombre."</li>");
            }
            ?>
        </ul>
        <?php
            if($fields[0]->id === $current_id) {
                if(count($bids) != 0) {
                    echo("<p>Tus Subastas</p>");
                    echo("<ul>");
                    foreach ($bids as $bid) {
                        echo("<li>".$bid->id."</li>");
                    }
                } else {
                    echo("<p>Todavía no tienes subastas!</p>");
                }
            }
        ?>
        <a href="{{ url('pages/create_bid') }}">Crear subasta</a>
        </ul>
    </body>
</html>
