<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Contact extends Model
{
    public static function getScheduleContacts($schedule_id = null, $user_id = null)
    {
        /*
        $flow_user_to_tenant = '0';
        $flow_tenant_to_user = '1';
        $contacts = DB::table('contacts')->select('*', DB::raw("'{$flow_user_to_tenant}' as flow"))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        $replies  = DB::table('replies')->select('*', DB::raw("'{$flow_tenant_to_user}' as flow"))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        return $contacts->union($replies)->orderBy('updated_at', 'asc')->get();
        */
        return self::where('user_id', $user_id)->where('schedule_id', $schedule_id)->orderBy('updated_at', 'asc')->get();
    }
    public static function getGeneralContacts($user_id = null, $is_read = 0)
    {
        return self::whereNull('schedule_id')
                ->where('user_id', $user_id)
                ->where('is_read', $is_read) 
                ->whereNull('reply_id')
                ->orderBy('updated_at', 'asc')->with('replies')->get();

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
