@extends('layouts.app')


@section('content')
<div class="row">
    <h1 class="col-md-4">{{ $item->nombre}}</h1>
    <h3 class="col-md-8">{{ $item->descripcion }}</h3>
</div>
<hr/>
<div class="row">
    <h4 class="col-md-4">Pertenece a la familia: {{ $item->familia->nombre }}</h4>
    <h4 class="col-md-4">Vendedor: {{ $item->user->name}} ({{ $item->user->email}})</h4>
    <h4 class="col-md-4">En subasta desde el {{ $item->created_at }}</h4>
</div>
<hr/>
<div class="col-md-6 col-md-offset-3 simple-border">
    <div class="col-md-9 col-md-offset-">
        <?php
        if($item->ends_at < date("Y-m-d H:i:s")) {
            if(($item->pujas->count() > 0)) {
                if($item->highestBidder()->id === \Auth::id()) {
                    ?>
                    <h3><strong>¡Felicidades! Ha ganado la subasta por
                        {{$item->precio}} €. 
                    </div>
                    <?php
                    if(\Auth::id() != $item->user->id) {
                        if($item->paid == false) {
                            ?>
                            <form action="{{route('payment')}}" method="POST">
                                @csrf
                                <div class="col-md-3 col-xs-12"> <h4>
                                    <input class="btn btn-primary" type=submit value='Pagar'></strong></h3>
                                    <input type="hidden" value="{{$item->id}}" id="articulo_id" name="articulo_id">
                                    <input type="hidden" value="{{\Auth::id()}}" id="user_id" name="user_id">
                                </div>
                            </form>
                            <?php
                        } else {
                            ?>
                            <div class="col-md-3 col-xs-12"> <h4>
                                <h4 class="strong">Ya ha pagado este artículo. Llegará pronto!</h4>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <?php
                } else {
                    ?>
                    <h3><strong>La subasta ha terminado. La ha ganado {{$item->highestBidder()->name}}</strong></h3>
                    <?php
                }
            } else {
                ?> 
                <h3><strong>La subasta ha terminado. <br/> <br/>¡No hubo pujas! :(</strong></h3>
                <?php
            }
        } else {
            ?>
            <h2 class='strong'>La subasta acaba a las:</h2><br/><h3 class="text-center"> {{$item->ends_at}}.</h3>
            <?php
            if(\Auth::check() && \Auth::id() !== $item->user_id) {
            ?>              
            </div>
            <div class="col-md-3 col-xs-12 mini-border"> 
                <h4>
                    <form action="{{route('createBid')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control " type="number" id="valor" name="valor" step="0.01" >
                            <input type=submit class='btn-primary text-center' value="¡Puja ahora!" style="width:100%" >
                            <input type="hidden" value="{{$item->id}}" id="articulo_id" name="articulo_id">
                            <input type="hidden" value="{{\Auth::id()}}" id="user_id" name="user_id">
                        </div>
                    </form>
                </h4>
            </div>
            <?php
        } 
        ?>
        <div class="col-md-9" style="margin-top:3em">
            <h2 class="strong">Histórico de pujas</h2>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th><h3>Quién</h3></th>
                        <th><h3>Cuánto</h3></th>
                        <th><h3>Cuándo</h3><th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        foreach ($item->pujas as $puja) {
                            ?>
                            <tr>
                                <td><h3>{{$puja->user->name}}</h3></td>
                                <td><h3>{{$puja->valor}}€</h3></td>
                                <td><h3>{{$puja->created_at}}</h3></td>
                            </tr>
                            <?php 
                        } 
                        ?>
                        
                    </tbody>    
                    
                </table>
                <?php
                if(!empty($item->highestBidder())) {
                    ?>
                    <h4 class="strong" style="color:red">¡Va ganando {{$item->highestBidder()->name}} con {{$item->highestBid()}}€!</h4>
                    <?php
                } else {
                    ?>
                    <h4 class="strong" style="color:red">Todavía no ha pujado nadie.</h4>
                    <?php
                }
                ?>
            </div>
            <?php 
        } 
        ?>
    </div>
    
    @endsection