@extends('layouts.app')
@section('content')

<div class="col-md-8 col-md-offset-2">
    <h4 class="strong">Datos del artículo a subastar:<h4>
        <div class="col-12 container" id="item_data_container">
            <form method="get" action="items/additem" class="additem form">
                <div class="col-md-3">
                    <label for="item">Nombre</label>
                    <input class="form-control" type="text" id="item" name="item" required="required"placeholder="Nombre del artículo">
                </div>
                <div class="col-md-2">
                    <label for="family">Familia</label>
                    <select class="form-control" type=select id="family" name="family" required="required" placeholder="Familia">
                        <?php
                        foreach ($families as $family) {
                            ?>
                            <option value="{{$family->id}}">{{$family->nombre}}</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="price">Precio de Salida</label>
                    <input class="form-control" step="0.01" type=number id="price" name="price" required="required" placeholder="Precio de salida">
                </div>
                <div class="col-md-3">
                    <label for="time">Tiempo activo</label>
                    <input class="form-control" type=number name="time" id="time" required="required" placeholder="Tiempo Activo (minutos)">
                </div>
                <div class="col-md-8" style="margin-top:10px">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" type=textarea rows="5" name="desc" required="required" placeholder="Descripción"></textarea>
                </div>
                <div class="col-md-4" style="margin-top:10px">
                    <input type=submit value="Subastar" class="btn btn-primary create-button">
                </div>
            </div>
        </form>
    </div>    
    @endsection