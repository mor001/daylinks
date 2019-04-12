<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Scopes\TenantScope;
use App\Notifications\CustomPasswordReset;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * モデルの「初期起動」メソッド
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tid', 'userid', 'name', 'kana', 'email', 'password', 'limit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }

    /**
     * 月の利用上限日数を返す
     */
    public function getLimitAttribute($value)
    {
        if($value < 0) {
          // マイナス値が入力されている場合は当月から引いた数を返す
          $lastDay = date("t", mktime(0, 0, 0, date('m'), 1, date('Y')));
          return $lastDay + $value;
        } else {
          // 整数値が入力されている場合はそのまま返す
          return $value;
        }
    }

}
