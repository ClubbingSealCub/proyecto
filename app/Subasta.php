<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    protected $fillable = [
        'id_subastador', 'id_articulo', 'created_at'
    ];
}
