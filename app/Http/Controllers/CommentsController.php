<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Schedule;
use App\Reserve;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function save(Request $request)
    {
      $comment = new Comment;
      $comment->schedule_id = $request->schedule_id;
      $comment->flow = $request->flow;
      $comment->is_read = false;
      $comment->contents = $request->contents;
      $comment->save();
      return ['result' => true, 'comments' => $comment::where('schedule_id', $request->schedule_id)->get()];
    }
    public function setRead(Request $request)
    {
      Comment::where('id', $request->id)->update(['is_read' => true]);
      return ['result' => true];
    }
}
