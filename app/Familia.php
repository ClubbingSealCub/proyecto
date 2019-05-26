<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{

    protected $table = 'familias';

    protected $fillable = [
        'nombre', 'descripcion', 
    ];
    
    public function articulos()
    {
        return $this->hasMany('App\Articulo');
    }

}