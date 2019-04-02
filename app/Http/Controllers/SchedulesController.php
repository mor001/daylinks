<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Contact;

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
      //echo 'Hello '.$request->subdomain;
      //return view('vuetest');

      $data = Schedule::getMonthly($y, $m);
      return ['schedules' => $data, 'y' => $y, 'm' => $m];
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
        return response()->json(['error' => 'Not Found'], 404);
      }
    }

    public function hoge(Request $request) {
      //echo 'Hello '.$request->subdomain;
      //return view('vuetest');
      return ['subdomain' => $request->subdomain, 'result' => true, 'message' => 'ほげええええ'];
    }
}
