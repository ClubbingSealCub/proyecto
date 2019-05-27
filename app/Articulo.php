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
        $puja = Puja::where('articulo_id', $this->id)->orderBy('valor', 'desc')->get();
        if(count($puja)>0){
            return $puja->first()->user;
        } else {
            return null;
        }
    }
    
    public function highestBid(){
        $puja = Puja::where('articulo_id', $this->id)->orderBy('valor', 'desc')->get();
        if(count($puja)>0){
            return $puja->first()->valor;
        }else{ 
            return $this->precio;
        }
        
    }
}
