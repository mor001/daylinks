<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Schedule;
use App\User;
use App\Holiday;

class Reserve extends Model
{
    public function getAdminMonthly($y = null, $m = null)
    {
      $week = [
        '日', //0
        '月', //1
        '火', //2
        '水', //3
        '木', //4
        '金', //5
        '土', //6
      ];
      $from = date('Y-m-d', mktime(0, 0, 0, $m, 1, $y));
      $to = date('Y-m-d', mktime(0, 0, 0, $m + 1, 0, $y));
      $lastDay = date('d', mktime(0, 0, 0, $m + 1, 0, $y));
      $holidays = Holiday::whereBetween('date', array($from, $to))->get();
      $schedules = Schedule::getMonthlyAdmin($y, $m);
      $users = User::all();
      $result = array();

      for($d = 1; $d <= $lastDay; $d++ ) {
        $today = date('Y-m-d', mktime(0, 0, 0, $m, $d, $y));
        $w = $week[date('w', mktime(0, 0, 0, $m, $d, $y))];
        $schedule = $this::_getSchedule($schedules, $today);

        $ary = ['date' => $today, 'label' => sprintf('%02d(%s)', $d, $w), 'schedule' => $schedule ];
        array_push($result, $ary);
      }

      return [
          'reserves' => $result,
          'y' => $y,
          'm' => $m,
          'holidays' => $holidays,
          'users' => $users,
      ];
    }
    
    private function _getSchedule($list, $date) {
      foreach($list as $s) {
        if($s->date === $date) return $s;
      }
      return false;
    }
    public function schedule()
    {
        return $this->belongsTo('App\Schedule');
    }
}
