<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    protected $fillable = ['id_vendedor', 'nombre', 'descripcion', 'id_familia'];
}
