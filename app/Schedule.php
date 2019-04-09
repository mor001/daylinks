<?php

namespace App;

use App\Scopes\TenantScope;
use App\Contact;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class Schedule extends Model
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
        'tid', 'date', 'title', 'description', 'register',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * 
     */
    public static function getMonthly($y = null, $m = null)
    {
        $current_y = $y == null ? date('Y') : $y;
        $current_m = $m == null ? date('m') : $m;
        $from = date('Y-m-d', mktime(0, 0, 0, $current_m, 1, $current_y));
        $to = date('Y-m-d', mktime(0, 0, 0, $current_m + 1, 0, $current_y));
        $now = date('Y-m-d H:i:s');
        $schedules = self::whereBetween('date', array($from, $to))
                     ->where('publish', '<=', $now)
                     ->with(['reserve' => function($query) {
                         $query->where('user_id', '=', Auth::user()->id);
                     }])
                     ->with('holiday')
                     ->select(['*'])->get();

        foreach($schedules as $schedule) {
            $schedule->contacts = Contact::getScheduleContacts($schedule->id, Auth::user()->id);
        }

        return $schedules;
        /*
        return self::whereBetween('date', array($from, $to))
                    ->with(['reserves' => function($query) {
                        $query->where('user_id', '=', Auth::user()->id);
                    }])
                    ->with('holiday')
                    ->with('contacts')
                    ->select(['*'])->get();
        */
    }
    /**
     * 
     */
    public static function getDaily($y = null, $m = null, $d = null)
    {
        $date = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y));
        $user = auth()->user();
        $schedule = self::where('date', $date)
                    ->with(['reserve' => function($query) {
                        $query->where('user_id', Auth::user()->id);
                    }])
                    ->with('holiday')
                    ->first();
        $schedule->contacts = Contact::getScheduleContacts($schedule->id, Auth::user()->id);
        return $schedule;
    }
    public static function countingReserve($schedules) 
    {
        $app_r = 0;
        $reserved = 0;
        $app_c = 0;
        $canceled = 0;
        foreach($schedules as $schedule) {
          if($schedule->reserve) {
            switch ($schedule->reserve->status) {
              case "app_r":
                $app_r++;
                continue 2;
              case "reserved":
                $reserved++;
                continue 2;
              case "app_c":
                $app_c++;
                continue 2;
              case "canceled":
                $canceled++;
                continue 2;
            }
          }
        }
        return ["app_r" => $app_r, "reserved" => $reserved, "app_c" => $app_c, "canceled" => $canceled];
    }
    public function reserve()
    {
        return $this->hasOne('App\Reserve', 'schedule_id', 'id');
    }
    public function contacts()
    {
        return $this->hasMany('App\Contact', 'schedule_id', 'id');
    }
    public function holiday()
    {
        return $this->hasOne('App\Holiday', 'date', 'date');
    }
}
