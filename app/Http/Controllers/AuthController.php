<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AuthController extends Controller
{
    //id,pwで認証してtokenを発行
    public function login($isAdmin = false)
    {
      $target = 'api';
      if($isAdmin) $target = 'admin';

      $credentials = request(['userid', 'password']);
      //logger('--- call login ---');
      //もし認証エラーなら
      if(!$token = auth($target)->attempt($credentials)){
          return response()->json(['error' => 'Unauthorized'], 401);
      }
      //OKならtoken発行
      return $this->respondWithToken($token, $isAdmin);
    }
    //id,pwで認証してtokenを発行
    public function adminLogin()
    {
      return $this->login(true);
    }
    public function logout()
    {
      auth()->logout();
      return response()->json(['message' => 'logout']);
    }
    //自分の情報返す
    public function me()
    {
      return response()->json(auth('api')->user());
    }
    //自分の情報返す
    public function adminMe()
    {
      return response()->json(auth('admin')->user());
    }
    //token発行（内部利用）
    protected function respondWithToken($token, $isAdmin = false)
    {
      if($isAdmin) {
        $user = auth('admin')->user();
      } else {
        $user = auth('api')->user();
      }
      $ret = response()->json([
        'tenant' => config('tenantName'),
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'bearer',
        'expire_in' => auth('api')->factory()->getTTL(),
      ]);
      return $ret;
    }
}
