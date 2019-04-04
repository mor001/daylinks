<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Contact;

class ContactsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function getGeneralContacts()
    {
      $contacts = Contact::whereNull('schedule_id')
                         ->where('user_id', Auth::user()->id)
                         ->where('is_read', 0) 
                         ->whereNull('reply_id')
                         ->orderBy('updated_at', 'asc')->with('replies')->get();
      return ['result' => true, 'contacts' => $contacts];
    }
    public function save(Request $request)
    {
      $contact = new Contact;
      $contact->user_id = $request->user_id;
      $contact->schedule_id = $request->schedule_id;
      $contact->is_read = false;
      $contact->contents = $request->contents;
      $contact->destination = $request->destination;
      $contact->reply_id = null;
      $contact->save();
      return ['result' => true, 'contacts' => Contact::getScheduleContact($request->schedule_id, Auth::user()->id)];
    }
    public function setRead(Request $request)
    {
      Contact::where('id', $request->id)->update(['is_read' => true]);
      return ['result' => true];
    }
}
