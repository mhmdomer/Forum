<?php

namespace App\Http\Controllers;

use App\Inspections\Spam as InspectionsSpam;
use Illuminate\Http\Request;
use App\Thread;
use App\Reply;
use App\Inspections\Spam;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($category, Thread $thread) {
        return $thread->replies()->paginate(10);
    }

    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => 'required']);
        (new Spam)->detect(request('body'));
        $reply = $thread->addReply([
            'user_id' => auth()->id(),
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
        return url($thread->path());
    }
}
