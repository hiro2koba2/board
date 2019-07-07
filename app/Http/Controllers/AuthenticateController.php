<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// API認証 jwtを利用する
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthenticateController extends Controller
{
    public function authenticate(Request $request) {
        // emailとパスワードで
        $credentials = $request->only('email', 'password');

        try {
          if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
          }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function getCurrentUser() {
        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(compact('user'));
    }

}
