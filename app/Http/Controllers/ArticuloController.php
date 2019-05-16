<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Articulo::latest()->paginate(5);
        return view('index', compact($data))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $item = $request->item;
            $desc = $request->desc;
            $familyID = DB::select('select id from familias where nombre = ?', [$request->family]);
            $seller_id = \Auth::user()->id;
            DB::table('articulos')->insertGetId([
                'id_vendedor' => $seller_id, 
                'nombre' => $item, 
                'descripcion'  => $desc, 
                'id_familia' => 1,
                'created_at'=> date("Y-m-d H:i:s"),
                ]);
        }
        //TODO: return view (tus articulos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id) {
            $fields = DB::select('select * from articulos where id=?', [$id]);
            $family_name = DB::select('select nombre from familias where id=?', [$fields[0]->id_familia]);
            $user_data = DB::select('select name, email from users where id=?', [$fields[0]->id_vendedor]);
            return view('pages/item', compact('fields', 'family_name', 'user_data'));
        }
    }

    public function fetch()
    {
        $user_id = Auth::id();        
        $items = DB::select('select * from articulos where id_vendedor=?', [$user_id]);
        return view('pages/create_bid', compact('items'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
