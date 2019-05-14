<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'proyecto')}}</title>

    </head>
    <body>
    <form method="post" action="{{url(item)}}" class="additem">
            <input type=text name="item" placeholder="Artículo">
            <input type=number name="price" placeholder="Precio">
            <input type=textarea name="desc" placeholder="Descripción">
            <input type=submit value="submit">
        </form>
    </body>
    </html>
    
    
<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {

    if(isset($_POST['submit'])) {
        $item = mysqli_real_escape_string($conn, $_POST['item']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $seller_id = 1;
        $family = 1;    
        DB::table('articulos')->insertGetId(['id_vendedor' => $seller_id, 'nombre' => $item, 'descripcion'  => $desc, 'id_familia' => $family]);
        echo($id);
    }
}
?>
