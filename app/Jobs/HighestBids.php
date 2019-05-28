<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Articulo;
use App\Message;

use DB;

class HighestBids implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    private $_item; 
    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct($item)
    {
        $this->_item = $item;
        //
    }
    
    /**
    * Execute the job.
    *
    * @return void
    */
    public function handle()
    {
        $result = DB::select(DB::raw("SELECT articulo_id,  MAX(VALOR) as valor FROM pujas WHERE articulo_id = " . $this->_item->id . " GROUP BY articulo_id order by articulo_id desc"));
        $puja_ganadora = \App\Puja::hydrate($result);
        if(!empty($result)){
            $message = new Message();
            $message->seen = false;
            $message->created_at = date('Y-m-d H:i:s');
            $message->user_id = $puja_ganadora->user_id;
            $message->articulo_id = $puja_ganadora->articulo_id;
            $message->content = "Has ganado la subasta!";
            $message->save();
            
            foreach ($this->_item->pujas as $puja) {
                if($puja->id != $puja_ganadora.id){                        
                    $message = new Message();
                    $message->seen = false;
                    $message->created_at = date('Y-m-d H:i:s');
                    $message->user_id = $puja->user_id;
                    $message->articulo_id = $puja->articulo_id;
                    $message->content = "¡Has ganado la subasta!";
                    $message->save();
                } else {
                    $message = new Message();
                    $message->seen = false;
                    $message->created_at = date('Y-m-d H:i:s');
                    $message->user_id = $puja->user_id;
                    $message->articulo_id = $puja->articulo_id;
                    $message->content = "Has perdido la subasta. ¡Más suerte la próxima vez!";
                    $message->save();
                }
            }
        }
        $message_owner = new Message();
        $message_owner->seen = false;
        $message_owner->created_at = date('Y-m-d H:i:s');
        $message_owner->content = "Ha acabado esta subasta.";
        $message->articulo_id = $this->_item->id;
        $message->save();
    }
}
