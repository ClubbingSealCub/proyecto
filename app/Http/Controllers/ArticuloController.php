<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
use App\Familia;

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
            $price = $request->price;
            $family = Familia::where('nombre', $request->family)->first()->id;
            $seller_id = \Auth::user()->id;
            $time = $request->time;
            $created_at = date("Y-m-d H:i:s");
            //para transformar en horas, *3.600 - días, *86.400 - minutos, *60
            $ends_at = date("Y-m-d H:i:s", strtotime($created_at) + $time*60); 

            $id = DB::table('articulos')->insertGetId([
                'id_vendedor' => $seller_id, 
                'nombre' => $item, 
                'descripcion'  => $desc, 
                'precio'=>$price,
                'id_familia' => $family,
                'created_at'=> $created_at,
                'ends_at'=>$ends_at
            ]);
            return view('user');
        }
    }

    public function searchByTerms(Request $request) 
    {
        if(!empty($request)) {
            $sqlTerms = array();

            if($request->has('family')) {
                $family = Familia::where('nombre', $request->input('family'))->first()->id;
                $sql_terms[] = "id_familia EQUALS '%$family%'";
            }
            
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
                $sql_terms[] = $sql_article; 
            } 

            if($request->has('minimumPrice')) {
                $minimumPrice = $request->input('minimumPrice');
                $sqlTerms[] = "precio >= '%$minimumPrice%'";
            }
            if($request->has('maximumPrice')) {
                $maximumPrice = $request->input('maximumPrice');
                $sqlTerms[] = "precio <= '%$maximumPrice%'";
            }

            $sql_query = implode(' AND ', $sqlTerms);
            $bids = DB::table('articulos')->whereRaw($sql_query);
            echo view('search', ['result'=>$bids]);
        }
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
            $current_id = Auth::id();
            $fields = DB::select('select * from articulos where id=?', [$id]);
            $family_name = DB::select('select nombre from familias where id=?', [$fields[0]->id_familia]);
            $user_data = DB::select('select * from users where id=?', [$fields[0]->id_vendedor]);
            $bid_data = DB::select('select * from pujas where id_usuario=? and id_articulo=? and valor=?', [$current_id, $id, $fields[0]->precio]);
            return view('pages/item', compact('current_id', 'fields', 'family_name', 'user_data', 'bid_data'));
        }
    }

    public function fetch()
    {
        //
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
