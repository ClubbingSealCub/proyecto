@extends('layouts.app')
@section('content')

<div class="row">
    <h1>{{ $user->name }} ({{ $user->email }})</h1>
</div>


<div class="row">
    <?php
    if($user == \Auth::user()) {
        if(\Auth::user()->messages->where('seen', false)->count() > 0) {
            ?>
            <h3> <img src="{{asset('images/message.png')}}" style="max-width:40px"> Tus Mensajes nuevos<a href="{{route('showMessages')}}"> Ver todos </a> </h3> 
            <div class="row">
                <ul>
                    
                    <?php
                    foreach (\Auth::user()->messages->where('seen', false) as $unseenMessage) {
                        ?>
                        <li> <a href="{{route('showItem', $unseenMessage->articulo_id)}}">{{$unseenMessage->content}} </a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php
        } else {
            ?>
            <h3> <img src="{{asset('images/message.png')}}" style="max-width:40px"> No tienes mensajes nuevos. <a href="{{route('showMessages')}}"> Ver todos. </a> </h3>
            <?php
        }
    }
    ?>
</div>

<div class="row">
    <?php
    if(count($user->articulos) == 0) {
        ?>
        <h3>{{$user->name}} todavía no tiene artículos en subasta.</h3><br/>
        <?php
    } else {
        ?>
        <h3>Los Artículos en subasta de {{ $user->name }} </h3><br/>
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
                </a>
            </div>
            <?php          
        }
        ?>
    </div>
</div>
<hr/>
<div class="row">
    <?php
    if(count($user->pujas) == 0) {
        ?>
        <h3>{{$user->name}} todavía no ha pujado en artículos.</h3><br/>
        <?php
    } else {
        ?>
        <h3>Las pujas de {{ $user->name }} </h3><br/>
        <br/>
        <?php
    }
    ?>
</div>
<div class="row">
    <?php
    foreach ($user->pujas as $puja) {
        ?>
        <div class='item-border col-md-3 col-xs-12'>
            <a href="{{route('showItem', $puja->articulo->id)}}">
                <h3>{{$puja->articulo->nombre}}</h3>
                <img src="{{asset('images/bid.png')}}" class="float-right col-md-3" style="top:0; right:0; position:absolute;">
                <h4>Valor puja: {{$puja->valor}}€</h4>
                <h4 class="float-right">{{$item->ends_at < date("Y-m-d H:i:s") ? "Finalizado" : "Activo" }}</h4>
            </a>
        </div>
        <?php          
    }
    ?>
</div>
</div>
@endsection