<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puja extends Model
{

    protected $table = 'pujas';

    protected $fillable = [
        'id_subasta', 'id_articulo', 'id_usuario', 'valor', 'created_at'
    ];
}
