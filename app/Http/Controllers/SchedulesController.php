<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;

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
