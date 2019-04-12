<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notice;
use App\Contact;

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
      /*
      return ['result' => true, 
              'notices' => Notice::where('user_id', Auth::user()->id)->where('is_read', 0)->orderBy('updated_at', 'desc')->get(),
              'contacts' => Contact::where('schedule_id', null)
                                   ->where('user_id', Auth::user()->id)
                                   ->where('is_read', 0)
                                   ->orderBy('updated_at', 'asc')->get()
      ];
      */
    }
    public function getAll()
    {
      return ['result' => true, 'notices' => Notice::where('user_id', Auth::user()->id)->get()];
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
