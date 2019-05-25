<?php

namespace App\Http\Controllers;

use App\Subasta;
use App\Familia;
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
        
    }

    public function searchByTerms(Request $request) 
    {
        if($request->has('family')) {
            $family = Familia::where('nombre', $request->input('family'))->first()->id;
        } else $family = null;
        
        if($request->has('searchterm')) {
            $searchTerms = preg_replace("/[^A-Za-z0-9 ]/", '', $request->input('searchterm'));
            $searchTermsArray = preg_split('/\s+/', $searchTerms, -1, PREG_SPLIT_NO_EMPTY);
            $searchTermBits = array();
            foreach($searchTermsArray as $term) {
                $term = trim($term);
                if(!empty($term)) {
                    $searchTermBits[] = "nombre LIKE '%$term%'";
                }
            }
            $sql_article = implode(' AND ', $searchTermBits);
            if(!is_null($family)) {
                $sql_article += "AND id_familia EQUALS '%$family%'";
            }
            $article_ids = DB::table('articulos')->whereRaw($sql_article)->get();
        } else if(!is_null($family)) {
            $article_ids = DB::select('select id from articulos where id_familia = ?', [$family]);
        } else {
            $article_ids = null;
        }

        if($request->has('minimumPrice')) {
            $minimumPrice = $request->input('minimumPrice');
        } else $minimumPrice = null;

        if($request->has('maximumPrice')) {
            $maximumPrice = $request->input('maximumPrice');
        } else $maximumPrice = null;

        $sqlTerms = array();
        
        if(!is_null($minimumPrice)) {
            $sqlTerms[] = "WHERE precio >= '%$minimumPrice%'";
        }

        if(!is_null($maximumPrice)) {
            $sqlTerms[] = "WHERE precio <= '%$maximumPrice%'";
        }

        if(!is_null($article_ids)) {
            $sql_strings = array();
            foreach($article_ids as $article_id) {
                $sql_strings[] = "WHERE id_articulo EQUALS '%$article_id'";
            }
            $sql_article = implode(' OR ');
            $sqlTerms[] = "('%$sql_article')";
        }
        $sql_query = implode(' AND ', $sqlTerms);
        $bids = DB::table('subastas')->selectRaw("* '%$sql_query'");
        echo view('search', ['result'=>$bids]);
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
