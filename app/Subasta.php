<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{

    protected $table = 'subastas';

    protected $fillable = [
        'id_subastador', 'id_articulo', 'created_at', 'ends_at', 'precio'
    ];
}
