<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Comment;

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
      return ['data' => $data, 'y' => $y, 'm' => $m];
    }

    public function create(Request $request)
    {
      $reserve = new Reserve;
      $reserve->schedule_id = $request->schedule_id;
      $reserve->user_id = Auth::user()->id;
      $reserve->leave_school_time = $request->leave_school_time;
      $reserve->status = 'accept';
      $reserve->save();
      $last_insert_id = $reserve->id;

      if(!empty($request->comment)) {
        $comment = new Comment;
        $comment->reserve_id = $last_insert_id;
        $comment->from_to = 'user_to_tenant';
        $comment->is_read = false;
        $comment->contents = $request->comment;
        $comment->save();
      }
      return ['result' => true];
    }

    public function getDaily($y = null, $m = null, $d = null)
    {
      $data = Schedule::getDaily($y, $m, $d);
      return ['data' => $data];
    }

    public function hoge(Request $request) {
      //echo 'Hello '.$request->subdomain;
      //return view('vuetest');
      return ['subdomain' => $request->subdomain, 'result' => true, 'message' => 'ほげええええ'];
    }
}
