<?php

namespace App;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

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
}
