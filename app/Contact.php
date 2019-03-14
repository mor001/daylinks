<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Contact extends Model
{
    public static function getContactAndReply($schedule_id = null, $user_id = null)
    {
        $contacts = DB::table('contacts')->select('*', DB::raw('\'user_to_tenant\' as flow'))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        $replies  = DB::table('replies')->select('*', DB::raw('\'tenant_to_user\' as flow'))->where('user_id', $user_id)->where('schedule_id', $schedule_id);
        return $contacts->union($replies)->orderBy('updated_at', 'asc')->get();
    }
}
