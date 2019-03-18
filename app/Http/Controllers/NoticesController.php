<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notice;

class NoticesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function getUnread()
    {
      return ['result' => true, 'notices' => Notice::where('user_id', Auth::user()->id)->where('is_read', 0)->get()];
    }
    public function getUnreadAdmin()
    {
      return ['result' => true, 'notices' => Notice::where('is_read', 0)->get()];
    }
    public function setRead(Request $request)
    {
      Notice::where('id', $request->id)->update(['is_read' => 1]);
      return $this->getUnread();
    }
}
