<?php

namespace App\Http\Controllers\Api\v2;

use Illuminate\Foundation\Testing\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticationController extends Controller
{
    public function login(Request $request, JWTAuth $JWTAuth)
    {
        \Debugbar::disable();

        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials['email'] = $request->header('email');
        $credentials['password'] = $request->header('password');

        try {
            $token = $JWTAuth->attempt($credentials);
            if (!$token) {
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
