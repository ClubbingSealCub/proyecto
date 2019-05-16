<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $fields[0]->nombre}}</title>

    </head>
    <body>
        <h1>{{ $fields[0]->nombre}}</h1>
        <p>{{ $fields[0]->descripcion }}</p>
        <p>Pertenece a la familia: {{ $family_name[0]->nombre }}</p>
        <p>Vendedor: {{ $user_data[0]->name}} ({{ $user_data[0]->email}})</p>
        <p>Añadido en: {{ $fields[0]->created_at }}</p>
    </body>
</html>
