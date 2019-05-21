<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Contact;
use App\Notice;
use App\Holiday;

class ReservesController extends Controller
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
    public function getAdminMonthly($y = null, $m = null)
    {
      $reserve = new Reserve();
      $result = $reserve->getAdminMonthly($y, $m);
      return $result;
    }
}
