<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $user = User::orderBy('name')->paginate(15);

        return view('users.index', ['users' => $user]);
    }

    public function get(){

    }
}
