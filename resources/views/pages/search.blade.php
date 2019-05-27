<table class="table table-bordered table-striped h4">
    <thead>
        <th colspan="1">Nombre</th>
        <th colspan="4">Descripción</th>
        <th colspan="1">Puja a superar</th>
        <th colspan="3">Familia</th>
        <th colspan="3">Acaba</th>
    </thead>
    <tbody>
<?php
// print_r($items);
foreach ($items as $item) {
?>
        <tr>
            <td colspan="1">{{$item->nombre}}</td>
            <td colspan="4">{{$item->descripcion}}</td>
            <td colspan="1">{{$item->highestBid()}}€</td>
            <td colspan="3">{{$item->familia->nombre}}</td>
            <td colspan="3">{{$item->ends_at}}</td>
        </tr>
<?php
}
?>
</tbody>