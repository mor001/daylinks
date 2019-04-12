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
      return ['result' => true, 'contacts' => Contact::getGeneralContacts(Auth::user()->id, 0)];
    }
    public function getGeneralContactsAll()
    {
      return ['result' => true, 'contacts' => Contact::getGeneralContacts(Auth::user()->id, 1)];
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
      return ['result' => true, 'contacts' => Contact::getScheduleContacts($request->schedule_id, Auth::user()->id)];
    }
    public function setRead(Request $request)
    {
      Contact::where('id', $request->id)->update(['is_read' => true]);
      return ['result' => true, 'contacts' =>  Contact::getGeneralContacts(Auth::user()->id, 0)];
    }
}
