<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'proyecto')}}</title>

    </head>
    <body>
        <form method="get" action="items/additem" class="additem">
            <input type=text name="item" placeholder="Artículo">
            <input type=textarea name="desc" placeholder="Descripción">
            {!! Form::select('families', $families, null) !!}
            <!--<input type=select name="family" placeholder="Familia">-->
            <input type=submit value="submit">
        </form>
    </body>
</html>
    
    
<?php
?>