<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($category, Thread $thread) {
        return $thread->replies()->paginate(2);
    }

    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => 'required']);
        $reply = $thread->replies()->create([
            'user_id' => auth()->id(),
            'thread_id' => request('thread_id'),
            'body' => request('body')
            ]);
            if(request()->expectsJson()) return $reply->load('user');
            Session::flash('message', 'Reply added successfully');
            return back();
        }
        
    public function update(Reply $reply) {
        $this->authorize('update', $reply);
        $this->validate(request(), ['body' => 'required']);
        $reply->update(['body' => request()->body]);
    }

    public function destroy(Reply $reply) {
        $this->authorize('delete', $reply);
        $thread = $reply->thread;
        $reply->delete();
        // Session::flash('message', 'Reply Deleted Successfully');
        return url($thread->path());
    }
}
