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
}
