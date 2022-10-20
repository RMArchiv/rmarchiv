<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    public function show_comments($user_id){
        $user = User::whereId($user_id)->first();

        
    }
}
