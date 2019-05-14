<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = [
        'nombre', 'id_vendedor', 'id_familia', 'descripcion', 
    ];
}
