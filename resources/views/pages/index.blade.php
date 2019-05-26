<!doctype html>
<!-- @extends('parent') -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name', 'proyecto')}}</title>

    </head>
    <body>
        <div id="salesContainer" width="50%">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width:"15%">Nombre</th>
                    <th width:"40%">Descripción</th>
                    <th width:"15%">Precio</th>
                    <th width:"15%">Familia</th>
                    <th width:"15%">Acaba</th>
                </tr>

                <?php
                    if(!empty($data)) {
                        foreach ($data as $line) {
                            echo("<tr>
                                    <td>".$line->nombre."</td>
                                    <td>".$line->descripcion."</td>
                                    <td>".$line->precio."</td>
                                    <td>".Familia::where('id', $line->id_familia)->first()->nombre."</td>
                                    <td>".$line->ends_at."</td>
                                </tr>");
                        }
                    }
                ?>

            </table>
        </div>
    </body>
</html>
