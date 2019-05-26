<table class="table table-bordered table-striped h4">
    <thead>
        <th colspan="1">Nombre</th>
        <th colspan="4">Descripción</th>
        <th colspan="1">Máx Bid</th>
        <th colspan="3">Familia</th>
        <th colspan="3">Acaba</th>
    </thead>
    <tbody>
<?php
// print_r($items);
foreach ($items as $item) {
?>
        <tr>
            <td>{{$item->nombre}}</td>
            <td>{{$item->descripcion}}</td>
            {{-- <td>{{$item->highestBid()}}€</td> --}}
            <td>{{$item->precio}}€</td>
            {{-- <td>{{$item->familia->nombre}}</td> --}}
            <td>{{$item->familia_id}}</td>
            <td>{{$item->ends_at}}</td>
        </tr>
<?php
}
?>
</tbody>