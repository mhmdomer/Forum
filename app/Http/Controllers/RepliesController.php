<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\Rules\SpamFree;

class RepliesController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($category, Thread $thread) {
        return $thread->replies()->paginate(10);
    }

    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => ['required', new SpamFree]]);
        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);
        return $reply->load('user');
    }

    public function update(Reply $reply) {
        $this->authorize('update', $reply);
        $this->validate(request(), ['body' => ['required', new SpamFree]]);
        $reply->update(['body' => request()->body]);
    }

    public function destroy(Reply $reply) {
        $this->authorize('delete', $reply);
        $thread = $reply->thread;
        $reply->delete();
        return url($thread->path());
    }
}
