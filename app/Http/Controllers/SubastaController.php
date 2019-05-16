<?php

namespace App\Http\Controllers;

use App\Subasta;
use Illuminate\Http\Request;
use Auth;
use DB;

class SubastaController extends Controller
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
    public function create()
    {
        return view('index');
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
            $user_id = \Auth::user()->id;
            $item_name = $request->item;
            $item_id = DB::select('select id from articulos where nombre=?', [$item_name]);
            $price = $request->precio;
            $days = $request->days;
            $created_at = date("Y-m-d H:i:s");
            //para transformar en horas, *3.600 - días, *86.400 - minutos, *60
            $ends_at = date("Y-m-d H:i:s", strtotime($created_at) + $days); 
            DB::table('subastas')->insertGetId([
                'id_subastador'=>$user_id,
                'id_articulo'=>$item_id,
                'precio'=>$price,
                'created_at'=>$created_at,
                'ends_at'=>$ends_at
            ]);
            return view('bid/'.$item_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fields = DB::select('select * from subastas where id=?', [$id]);
        $item_data = DB::select('select * from articulos where id=?', [$fields[0]->id_articulo]);
        $family_data = DB::select('select * from familias where id=?', [$item_data[0]->id_familia]);
        $user_data = DB::select('select * from users where id=?', [$fields[0]->id_subastador]);
        $bid_data = DB::select('select * from pujas where id_usuario=? and id_subasta=?', [$user_data[0]->id, $fields[0]->id]);
        return view('pages/bid', compact('fields', 'item_data', 'family_data', 'user_data', 'bid_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function edit(Subasta $subasta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subasta $subasta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subasta  $subasta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subasta $subasta)
    {
        //
    }
}
