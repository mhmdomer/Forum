<?php

namespace App\Http\Controllers;

use App\Thread;

class LockThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function lock(Thread $thread) {
        $thread->update(['locked' => true]);
        return response(['message' => 'Thread Locked'], 200);
    }

    public function unlock(Thread $thread) {
        $thread->update(['locked' => false]);
        return response(['message' => 'Thread unlocked'], 200);
    }
}
