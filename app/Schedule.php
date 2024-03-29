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
use Illuminate\Support\Facades\Log;

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
        'tid', 'date', 'title', 'description', 'register', 'publish', 'status'
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
    public static function getMonthly($y = null, $m = null, $publish = true)
    {
        $current_y = $y == null ? date('Y') : $y;
        $current_m = $m == null ? date('m') : $m;
        $from = date('Y-m-d', mktime(0, 0, 0, $current_m, 1, $current_y));
        $to = date('Y-m-d', mktime(0, 0, 0, $current_m + 1, 0, $current_y));
        // ここでholidayを取得するとschedulesのデータに依存するので別途取得する
        $schedules = self::whereBetween('date', array($from, $to))
                     // ->with('holiday')
                     ->when($publish === true, function ($query) {
                       $now = date('Y-m-d H:i:s');
                       return $query->where('publish', '<=', $now);
                     })
                     ->with(['reserve' => function($query) {
                         $query->where('user_id', '=', Auth::user()->id);
                     }])
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
        if($schedule) {
          $schedule->contacts = Contact::getScheduleContacts($schedule->id, Auth::user()->id);
        }
        return $schedule;
    }
    /**
     * 
     */
    public static function getMonthlyAdmin($y = null, $m = null)
    {
        $from = date('Y-m-d', mktime(0, 0, 0, $m, 1, $y));
        $to = date('Y-m-d', mktime(0, 0, 0, $m + 1, 0, $y));
        // ここでholidayを取得するとschedulesのデータに依存するので別途取得する
        $schedules = self::whereBetween('date', array($from, $to))
                       ->with('reserves')
                       ->with('holiday')
                       ->select(['*'])->get();
        return $schedules;
    }
    public static function getDailyAdmin($y = null, $m = null, $d = null)
    {
        $date = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y));
        $schedule = self::where('date', $date)
                    ->with('reserves')
                    ->with('holiday')
                    ->first();
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
    public static function regist($date, $title, $description, $register, $publish)
    {
      //$validator = \Validator::validate(  $this->attributes, $rules );
      //$validator->passes();  // 成功したら true
      //$validator->fails();   // 失敗したら true
      $ret = self::updateOrCreate(
        ['date' => $date],
        ['tid' => config('tid'),
         'date' => $date,
         'title' => $title,
         'description' => $description,
         'register' => $register,
         'publish' => $publish,
         'status' => 'open',
        ] 
      );
      Log::info($ret);
    }
    public function scopePublish($query, $date = null)
    {
        if(empty($date)) return '';
        return $query->where('publish', '<=', $date);
    }
    public function reserves()
    {
        return $this->hasMany('App\Reserve', 'schedule_id');
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
