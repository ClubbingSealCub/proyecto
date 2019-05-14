<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view('pages.index');
    }
/*
    public function additem() {
        return view('pages.additem');
    }
*/
 
    public function additem(Request $request) {
            if(empty($request->additem)) {
                return view('pages.additem');
            } else ($request->additem);
        }



    public function about() {
        return view('pages.about');
    }
}
