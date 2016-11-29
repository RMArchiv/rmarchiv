<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        return view('search.index');
    }

    public function search($term){
        return view('search.index');
    }
}
