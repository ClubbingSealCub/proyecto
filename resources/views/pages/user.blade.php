@extends('layouts.app')
@section('content')

<div class="row">
    <h1>{{ $user->name }} ({{ $user->email }})</h1>
</div>
<div class="row">
    
    <?php
    if(count($user->articulos) == 0) {
        ?>
        <p>{{$user->name}} todavía no tiene artículos en subasta.</p>
        <?php
    } else {
        ?>
        <p>Los Artículos en subasta de {{ $user->name }} </p><br/>
        <?php
    }
    ?>
    <div class="row">
        <?php
        foreach ($user->articulos as $item) {
            ?>
            <div class='item-border col-md-3 col-xs-12'>
                <a href="{{route('showItem', $item->id)}}">
                    <h3>{{$item->nombre}}</h3>
                    <img src="{{asset('images/item.png')}}" class="float-right col-md-3" style="top:0; right:0; position:absolute;">
                    <h4>Precio actual: {{$item->precio}}€</h4>
                    <h4 class="float-right">{{$item->ends_at < date("Y-m-d H:i:s") ? "Finalizado" : "Activo" }}</h4>
                </a></div>
                <?php          
            }
            ?>
            @endsection