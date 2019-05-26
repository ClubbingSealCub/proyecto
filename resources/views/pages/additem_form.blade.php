@extends('layouts.app')
@section('content')

<div class="col-md-8 col-md-offset-2">
    <form method="get" action="items/additem" class="additem form">
        <div class="form-group">
            <input class="form-control" type=text name="item" required="required" placeholder="Nombre del Artículo">
            <input class="form-control" type=textarea name="desc" required="required" placeholder="Descripción">
            <select class="form-control" type=select name="family" required="required" placeholder="Familia">
                <?php
                foreach ($families as $family) {
                    ?>
                    <option value="{{$family}}">{{$family}}</option>
                    <?php
                }
                ?>
            </select>
            <input class="form-control" step="0.01" type=number name="price" required="required" placeholder="Precio de salida">
            <input class="form-control" type=number name="time" required="required" placeholder="Tiempo Activo (minutos)">
            
        </div>
        <input type=submit value="submit">
    </form>
</div>

@endsection