<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Reply;
use App\Rules\SpamFree;
use Exception;
use Illuminate\Support\Facades\Gate;

class RepliesController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($category, Thread $thread) {
        return $thread->replies()->paginate(10);
    }

    public function store($channelId, Thread $thread) {
        if (Gate::denies('create', new Reply())) {
            return response(['message' => 'You are posting too frequently, take a break :)'], 422);
        }
        $this->validate(request(), ['body' => ['required', new SpamFree]]);
        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);
        return $reply->load('user');
    }

    public function update(Reply $reply) {
        if(Gate::denies('update', $reply))
            return response(['message' => 'You are updating too frequently, please take a break :)'], 422);
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
