<!doctype html>
<!-- @extends('parent') -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'proyecto')}}</title>

    </head>
    <body>
    <table class="table table-bordered table-striped">
        <tr>
            <th width:"15%">Nombre</th>
            <th width:"35%">Vendedor</th>
            <th width:"35%">Descripción</th>
            <th width:"15%">Familia</th>
        </tr>
        @foreach $data as $row
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->seller }}</td>
            <td>{{ $row->desc }}</td>
            <td>{{ $row->family }}</td>
        </tr>
        @endforeach
    </table>
    {!! $data->links() !!}
    </body>
</html>
