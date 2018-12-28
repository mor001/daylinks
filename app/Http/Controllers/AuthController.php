<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    //id,pwで認証してtokenを発行
    public function login()
    {
        $credentials = request(['userid', 'password']);
        //logger('--- call login ---');
        //もし認証エラーなら
        if(!$token = auth('api')->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //OKならtoken発行
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'logout']);
    }

    //自分の情報返す
    public function me()
    {
        return response()->json(auth()->user());
    }

    //token発行（内部利用）
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expire_in' => auth('api')->factory()->getTTL(),
        ]);
    }
}
