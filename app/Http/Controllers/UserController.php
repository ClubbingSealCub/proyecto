<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_id = Auth::id();
        if(is_null($id)) {
            $id = $current_id;
        }
        $fields = DB::select('select * from users where id=?', [$id]);
        $items = DB::select('select * from articulos where id_vendedor=?', [$id]);
        $bids = DB::select('select * from pujas where id_usuario=?', [$id]);
        return view('pages/user', compact('current_id', 'fields', 'items', 'bids'));
    }

    public function showCurrent()
    {
        $current_id = Auth::id();
        if(is_null($current_id)) {
            return view('login');
        }
        $fields = DB::select('select * from users where id=?', [$current_id]);
        $items = DB::select('select * from articulos where id_vendedor=?', [$current_id]);
        $bids = DB::select('select * from pujas where id_usuario=?', [$current_id]);
        return view('pages/user', compact('current_id', 'fields', 'items', 'bids'));
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
