<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Puja;

class Articulo extends Model
{

    protected $table = 'articulos';

    protected $fillable = [
        'nombre', 'user_id', 'familia_id', 'descripcion', 'precio', 'ends_at'
    ];

    
    public function pujas()
    {
        return $this->hasMany('App\Puja');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function familia()
    {
        return $this->belongsTo('App\Familia');
    }
    
    public function highestBidder(){
        return Puja::where('articulo_id', $this->id)->orderBy('valor', 'desc')->get()->first()->user;
        
    }
    
    public function highestBid(){
        return Puja::where('articulo_id', $this->id)->orderBy('valor', 'desc')->get()->first();
        
    }
}
