@extends('layouts.app')
<?php
use App\Familia;
?>

@section('content')
<h1>Subastas que acabarán proximamente. ¡Date prisa! </h1>
<div id="salesContainer" class="col-md-12">
    <div class="table table-responsive">
    <table class="table table-bordered table-striped h4 ">
        <thead>
            <th class="col-md-1">Nombre</th>
            <th class="col-md-4">Descripción</th>
            <th class="col-md-1">Precio</th>
            <th class="col-md-3">Familia</th>
            <th class="col-md-3">Acaba</th>
        </thead>
        <tbody>
        <?php
        if(!empty($current)) {
            foreach ($current as $line) {
        ?>
            <tr>
                    <td>
                            <a href="{{route('showItem', $line->id)}}">
                        {{$line->nombre}}
                            </a>
                    </td>
                    <td>{{$line->descripcion}}</td>
                    <td>{{$line->precio}}</td>
                    <td>{{$line->familia->nombre}}</td>
                    <td>{{$line->ends_at}}</td>
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
        
    </table></div>
</div>


<h1>Productos que ya se han vendido, ¡sé más rápido la próxima vez ! </h1>
<div id="pastSales" class="col-md-12">
    <div class="table table-responsive">
    <table class="table table-bordered table-striped h4 ">
        <thead>
            <th class="col-md-1">Nombre</th>
            <th class="col-md-4">Descripción</th>
            <th class="col-md-1">Precio</th>
            <th class="col-md-3">Familia</th>
            <th class="col-md-3">Acaba</th>
        </thead>
        <tbody>
        <?php
        if(!empty($past)) {
            foreach ($past as $line) {
        ?>
            <tr>
                    <td>
                            <a href="{{route('showItem', $line->id)}}">
                        {{$line->nombre}}
                            </a>
                    </td>
                    <td>{{$line->descripcion}}</td>
                    <td>{{$line->precio}}</td>
                    <td>{{$line->familia->nombre}}</td>
                    <td>{{$line->ends_at}}</td>
            </tr>
        <?php
            }
        }
        ?>
        </tbody>
        
    </table></div>
</div>

@endsection