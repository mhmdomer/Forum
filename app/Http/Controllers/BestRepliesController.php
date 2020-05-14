<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;

class BestRepliesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Reply $reply) {
        $this->authorize('update', $reply->thread);
        $reply->makeBest();
        if(request()->wantsJson()) return response($reply, 200);
        return back()->with('message', 'Reply marked as best');
    }
}
