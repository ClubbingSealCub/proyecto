<?php

namespace App\Http\Controllers;

use App\Puja;
use Illuminate\Http\Request;
use Auth;

class PujaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->user_id;
        $articulo_id = $request->articulo_id;
        $valor = $request->valor;
        
        $articulo = \App\Articulo::find($articulo_id);

        if ($articulo->HighestBid() < $valor){
            $puja = new Puja();
            $puja->user_id = $user_id;
            $puja->articulo_id = $articulo_id;
            $puja->valor = $valor;   
            $puja->save();
            return \Redirect::route('showItem', $puja->articulo_id)->with('success','¡Tu puja ha sido aceptada!');
        }else{
            return \Redirect::route('showItem', $articulo_id)->with('error','¡Tu puja es demasiado baja!');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty($request)) {
            $item_id = $request->item;
            $user_id = \Auth::user()->id;
            $price = $request->price;
            DB::table('pujas')->insertGetID([
                'id_usuario' => $user_id,
                'id_articulo' => $item_id,
                'precio' => $price,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            return view('item/'.$id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Puja  $puja
     * @return \Illuminate\Http\Response
     */
    public function show(Puja $puja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puja  $puja
     * @return \Illuminate\Http\Response
     */
    public function edit(Puja $puja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puja  $puja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puja $puja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puja  $puja
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puja $puja)
    {
        //
    }
}
