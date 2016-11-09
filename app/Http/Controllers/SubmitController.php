<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SubmitController extends Controller
{
    public function index(){
        return view('submit.index');
    }
}
