<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Contact;
use App\Notice;
use App\Holiday;

class SchedulesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('subdomain');
    }

    public function getMonthly($y = null, $m = null)
    {
      $from = date('Y-m-d', mktime(0, 0, 0, $m, 1, $y));
      $to = date('Y-m-d', mktime(0, 0, 0, $m + 1, 0, $y));
      $holidays = Holiday::whereBetween('date', array($from, $to))->get();
      $data = Schedule::getMonthly($y, $m);
      $unread_notice = Notice::getUnreadCount();
      $count = Schedule::countingReserve($data);
      return ['schedules' => $data, 
              'unread_notice' => $unread_notice, 
              'y' => $y, 'm' => $m, 
              'limit' => Auth::user()->limit,
              'count' => $count,
              'holidays' => $holidays,
             ];
    }
    public function getAdminMonthly($y = null, $m = null)
    {
      $from = date('Y-m-d', mktime(0, 0, 0, $m, 1, $y));
      $to = date('Y-m-d', mktime(0, 0, 0, $m + 1, 0, $y));
      $holidays = Holiday::whereBetween('date', array($from, $to))->get();
      $data = Schedule::getMonthly($y, $m, false);
      return ['schedules' => $data, 
              'y' => $y, 'm' => $m, 
              'holidays' => $holidays,
             ];
    }
    public function getDaily($y = null, $m = null, $d = null)
    {
      $data = Schedule::getDaily($y, $m, $d);
      if(!empty($data)) {
        // 取得した問合せは既読に設定する
        foreach($data->contacts as $contact) {
          Contact::where('id', $contact->id)->update(['is_read' => true]);
        }
        return ['schedules' => $data];
      } else {
        return ['schedules' => $data];
        //return response()->json(['error' => 'Not Found'], 404);
      }
    }
    public function getAdminDaily($y = null, $m = null, $d = null)
    {
      $data = Schedule::getDaily($y, $m, $d);
      return ['schedules' => $data];
    }
    public function getAdminDailyById($id)
    {
      $data = Schedule::find($id);
      return ['schedules' => $data];
    }
    public function reserve(Request $request)
    {
      if(empty($request->reserve_id)) {
        $reserve = new Reserve;
        $reserve->schedule_id = $request->schedule_id;
        $reserve->user_id = Auth::user()->id;
        $reserve->leave_school_time = $request->leave_school_time;
        $reserve->status = $request->status;
      } else {
        $reserve = Reserve::where('id', $request->reserve_id)->first();
        $reserve->leave_school_time = $request->leave_school_time;
        $reserve->status = $request->status;
      }
      $reserve->save();
      //$last_insert_id = $reserve->id;
      return ['result' => true];
    }
    public function save(Request $request)
    {
      if(is_array($request->dateList)) {
        foreach($request->dateList as $date) {
          Schedule::regist($date['date'], $request->title, $request->description, Auth::user()->id, $request->publish);
        }
      }
      return ['result' => true];
    }
}
