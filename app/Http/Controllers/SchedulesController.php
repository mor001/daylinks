<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function hello(Request $request) {
      //echo 'Hello '.$request->subdomain;
      //return view('vuetest');
      return ['subdomain' => $request->subdomain, 'result' => true];
    }

    public function hoge(Request $request) {
      //echo 'Hello '.$request->subdomain;
      //return view('vuetest');
      return ['subdomain' => $request->subdomain, 'result' => true, 'message' => 'ほげええええ'];
    }
}
