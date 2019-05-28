@extends('layouts.app')
@section('content')

<?php
if(empty(\Auth::id())) {
    return view('login')->with('error', 'Tiene que ingresar para ver esa página');
}

if((\Auth::user()->messages->where('seen', false)->count() < 1)) {
    ?>
    <h2>No tiene mensajes sin leer.</h2>
    <?php
} else {
    ?> <h2> Mensajes sin leer: </h2>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped h4">
            <thead>
                <th colspan="3">Artículo</th>
                <th colspan="6">Contenido</th>
                <th colspan="3">Fecha</th>
            </thead>
            <tbody>
                <?php
                foreach (\Auth::user()->messages->where('seen', false)->sortByDesc('created_at') as $unseenMessage) {
                    ?>
                    <tr>
                        <td colspan="3"><a href="{{route('showItem', $unseenMessage->articulo_id)}}">{{$unseenMessage->articulo->nombre}}</a></td>
                        <td colspan="6">{{$unseenMessage->content}}</td>
                        <td colspan="3">{{$unseenMessage->created_at}}</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}
if((\Auth::user()->messages->where('seen', true)->count() < 1)) {
    ?>
    <br/>
    <hr/>
    <h2>No tiene mensajes ya leídos.</h2>
    <?php
} else {
    ?> 
    <br/>
    <hr/>
    <br/><h2> Mensajes previamente leídos: </h2>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped h4">
            <thead>
                <th colspan="3">Artículo</th>
                <th colspan="6">Contenido</th>
                <th colspan="3">Fecha</th>
            </thead>
            <tbody>
                <?php
                foreach (\Auth::user()->messages->where('seen', true)->sortByDesc('created_at') as $seenMessage) {
                    ?>
                    <tr>
                        <td colspan="3"><a href="{{route('showItem', $seenMessage->articulo_id)}}">{{$seenMessage->articulo->nombre}}</a></td>
                        <td colspan="6">{{$seenMessage->content}}</td>
                        <td colspan="3">{{$seenMessage->created_at}}</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}
foreach (\Auth::user()->messages->where('seen', false) as $unseenMessage) {
    $unseenMessage->seen = true;
    $unseenMessage->save();
    
}

?>

@endsection