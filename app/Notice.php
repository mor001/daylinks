<?php

namespace App;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notice extends Model
{
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

    public static function getUnreadCount()
    {
        return self::where('user_id', '=', Auth::user()->id)->where('is_read', 0)->count();
    }
}
