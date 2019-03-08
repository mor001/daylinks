<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'reserve_id', 'id');
    }
}
