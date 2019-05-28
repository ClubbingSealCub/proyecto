<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = [
        'user_id', 'content', 'created-at', 'seen'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setAsSeen()
    {
        $this->seen = true;
    }

    public function articulo()
    {
        return $this->belongsTo('App\Articulo');
    }
}
