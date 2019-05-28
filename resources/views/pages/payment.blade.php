@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="get" action="{{route('payItem')}}" class="payment form">
            <div class="form-group">
                <div class="col-12">
                    <div class="col-12 container" id="send_data_container">
                        <h3>Datos de envío</h3>
                        <label for="adr"><i class="fa fa-address-card-o"></i> Dirección</label>
                        <input class="form-control" type="hidden" value="{{$item_id}}" id="articulo_id" name="articulo_id">
                        <input class="form-control" type="hidden" value="{{\Auth::id()}}" id="user_id" name="user_id">
                        <input class="form-control" type="text" id="address" name="address" placeholder="Calle Falsa 123">
                        <br/>
                        <div class="col-md-4">
                            <label for="city"><i class="fa fa-institution"></i> Ciudad</label>
                            <input class="inline-form" type="text" id="city" name="city" placeholder="Las Palmas de GC">
                        </div>
                        <div class="col-md-4">
                            <label for="state">Provincia</label>
                            <input class="inline-form" type="text" id="state" name="state" placeholder="Las Palmas">
                        </div>
                        <div class="col-md-4">
                            <label for="zip">Código Postal</label>
                            <input class="inline-form" type="text" id="zip" name="zip" placeholder="00000">
                        </div>
                    </div>
                    <hr/>
                    <div class="col-12 container" id="pay_data_container">
                        <h3>Datos de pago</h3>
                        <div class="col-md-4">
                            <label for="cardname">Nombre</label>
                            <input class="inline-form" type="text" id="cardname" name="cardname" placeholder="Nombre">
                        </div>
                        <div class="col-md-4">
                            <label for="cardnumber">Número</label>
                            <input class="inline-form" type="text" id="cardnumber" name="cardnumber" placeholder="1111-2222-3333-4444">
                        </div>
                        <div class="col-md-4">
                            <label for="expmonth">Mes Expiración</label>
                            <input class="inline-form" type="text" id="expmonth" name="expmonth" placeholder="Mayo">
                            {{-- <input class="inline-form" type="text" id="expmonth" name="expmonth" placeholder="{{date("F")}}"> --}}
                        </div>
                        <br/>
                        <div class="col-md-4">
                            <label for="expyear">Año Expiración</label>
                            <input class="inline-form" type="text" id="expyear" name="expyear" placeholder="{{date("Y")}}">
                        </div>
                        <div class="col-md-4">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="352">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Pagar" class="btn btn-primary pay-button">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
