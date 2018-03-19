<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers\Api\v2;

use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Testing\HttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthenticationController extends Controller
{
    public function login(Request $request, JWTAuth $JWTAuth)
    {
        \Debugbar::disable();

        $credentials['email'] = $request->header('email');
        $credentials['password'] = $request->header('password');

        try {
            $token = $JWTAuth->attempt($credentials);
            if (! $token) {
                throw new AccessDeniedHttpException();
            }
        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()->json([
            'status_code' => '200',
            'message'     => 'ok',
            'token'       => $token,
        ]);
    }
}
