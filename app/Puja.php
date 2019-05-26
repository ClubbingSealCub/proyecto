<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puja extends Model
{

    protected $table = 'pujas';

    protected $fillable = [
        'articulo_id', 'user_id', 'valor', 'created_at'
    ];

    public function articulo()
    {
        return $this->belongsTo('App\Articulo');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
