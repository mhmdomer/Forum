<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Reply;

class ReplyController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread) {
        $this->validate(request(), ['body' => 'required']);
        $thread->replies()->create([
            'user_id' => auth()->id(),
            'thread_id' => request('thread_id'),
            'body' => request('body')
        ]);
        return back();
    }
}
