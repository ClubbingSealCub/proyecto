<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
use App\Familia;
use App\Articulo;

class ArticuloController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $curr_date = date("Y-m-d H:i:s");
        $current = Articulo::where('ends_at', '>', $curr_date)->orderBy('ends_at', 'asc')->get();
        $past = Articulo::where('ends_at', '<', $curr_date)->orderBy('ends_at', 'desc')->take(5)->get();
        return view('pages/index', compact('current', 'past'));
        
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
            $family = $request->family;
            $seller_id = \Auth::user()->id;
            $time = $request->time;
            $created_at = date("Y-m-d H:i:s");
            //para transformar en horas, *3.600 - días, *86.400 - minutos, *60
            $ends_at = date("Y-m-d H:i:s", strtotime($created_at) + $time*60); 
            
            $articulo = DB::table('articulos')->insertGetId([
                'user_id' => $seller_id, 
                'nombre' => $item, 
                'descripcion'  => $desc, 
                'precio'=>$price,
                'familia_id' => $family,
                'created_at'=> $created_at,
                'ends_at'=>$ends_at
                ]);
                return \Redirect::route('showItem', $articulo)->with('success','¡Tu subasta se ha creado satisfactoriamente!');
            }
        }
        
        public function searchByTerms(Request $request) 
        {
            if(!empty($request)) {
                $sql_terms = array();
                if(!empty($request->family)) {
                    $family = $request->family;
                    $sql_terms[] = "familia_id = ".$family;
                }
                
                if(!empty($request->searchterm)) {
                    $searchTerms = preg_replace("/[^A-Za-z0-9 ]/", '', $request->input('searchterm'));
                    $searchTermsArray = preg_split('/\s+/', $searchTerms, -1, PREG_SPLIT_NO_EMPTY);
                    $searchTermBits = array();
                    foreach($searchTermsArray as $term) {
                        $term = trim($term);
                        if(!empty($term)) {
                            $searchTermBits[] = "(nombre LIKE '%$term%' OR descripcion LIKE '%$term%')";
                        }
                    }
                    $sql_article = implode(' AND ', $searchTermBits);
                    $sql_terms[] = $sql_article; 
                } 
                
                if(!empty($request->minimumPrice)) {
                    $minimumPrice = $request->input('minimumPrice');
                    $sql_terms[] = "precio >= ".$minimumPrice;
                }
                if(!empty($request->maximumPrice)) {
                    $maximumPrice = $request->input('maximumPrice');
                    $sql_terms[] = "precio <= ".$maximumPrice;
                }
                
                $sql_query = implode(' AND ', $sql_terms);         
                $result = DB::select(DB::raw("SELECT * FROM articulos WHERE ".$sql_query));
                $items = Articulo::hydrate($result);
                return view('pages/search', compact('items'));
            }
        }
        
        public function pay(Request $request) 
        {
            if(!empty($request)) 
            {
                //
            }
        }
        
        public function checkValidity(Request $request) 
        {
            if($request->user_id == \Auth::id()) {
                if(!empty($request->articulo_id)) {
                    $item_id = $request->articulo_id;
                    return view('pages/payment', compact('item_id'));
                } else {
                    return \Redirect::route('/')->with('error','No estás autorizado a ver esa página.');                
                }
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
                $item = Articulo::find($id);
                return view('pages/item', compact('current_id', 'item'));
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
    