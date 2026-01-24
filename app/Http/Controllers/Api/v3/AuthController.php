<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v3;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        \Debugbar::disable();

        $email = (string) $request->input('email', '');
        $password = (string) $request->input('password', '');

        if ($email === '' || $password === '') {
            return response()->json([
                'status_code' => 422,
                'message' => 'Email and password are required.',
            ], 422);
        }

        $user = User::where('email', '=', $email)->first();
        if (! $user || ! Hash::check($password, $user->password)) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $plainToken = bin2hex(random_bytes(32));
        $user->api_token = hash('sha256', $plainToken);
        $user->api_token_created_at = now();
        $user->api_token_last_used_at = now();
        $user->save();

        return response()->json([
            'status_code' => 200,
            'message' => 'Login successful',
            'data' => [
                'token' => $plainToken,
                'token_type' => 'Bearer',
            ],
        ]);
    }
}
