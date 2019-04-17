<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
    //id,pwで認証してtokenを発行
    public function login($isAdmin = false)
    {
      $target = 'api';
      if($isAdmin) $target = 'admin';

      $credentials = request(['userid', 'password']);

      //もし認証エラーなら
      if(!$token = auth($target)->attempt($credentials)){
        return response()->json(['login' => false, 'error' => 'The login attempt failed.'], 200);
      }
      //OKならtoken発行
      return $this->respondWithToken($token, $isAdmin);
    }
    //管理画面ログイン
    public function adminLogin()
    {
      return $this->login(true);
    }
    //ログアウト
    public function logout($isAdmin = false)
    {
      $target = 'api';
      if($isAdmin) $target = 'admin';

      try {
        auth($target)->logout();
      } catch (Exception $e) {
        // トークン有効期限切れなら401を返す
        return response()->json(['login' => false, 'message' => 'logout'], 401);
      }
      return response()->json(['login' => false, 'message' => 'logout']);
    }
    //管理画面ログアウト
    public function adminLogout()
    {
      return $this->logout(true);
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
        'login' => true,
        'tenant' => config('tenantName'),
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'bearer',
        'expire_in' => auth('api')->factory()->getTTL(),
      ]);
      return $ret;
    }
}
