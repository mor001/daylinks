<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Contact extends Model
{
    public static function getScheduleContact($schedule_id = null, $user_id = null)
    {
        /*
        $flow_user_to_tenant = '0';
        $flow_tenant_to_user = '1';
        $contacts = DB::table('contacts')->select('*', DB::raw("'{$flow_user_to_tenant}' as flow"))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        $replies  = DB::table('replies')->select('*', DB::raw("'{$flow_tenant_to_user}' as flow"))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        return $contacts->union($replies)->orderBy('updated_at', 'asc')->get();
        */
        return DB::table('contacts')->where('user_id', $user_id)->where('schedule_id', $schedule_id)->orderBy('updated_at', 'asc')->get();
    }

    public function replies()
    {
        return $this->hasMany('App\Contact', 'reply_id', 'id');
    }
 
    public function parent()
    {
        return $this->belongsTo('App\Contact', 'reply_id');
    }
}
