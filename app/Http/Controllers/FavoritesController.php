<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Reply;
use App\Thread;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply) {
        $reply->favorite();
        if (request()->wantsJson()){
            return response(['status' => 'Success']);
        }
        return back();
    }

    public function storeThread($thread) {
        $thread = Thread::findOrFail($thread);
        $thread->favorite();
        if (request()->wantsJson()){
            return response(['status' => 'Success']);
        }
        return back();
    }

    public function destroy(Reply $reply) {
        $reply->unFavorite();
        if (request()->wantsJson()){
            return response(['status' => 'Success']);
        }
        return back();
    }

    public function destroyThread($thread) {
        $thread = Thread::findOrFail($thread);
        $thread->unFavorite();
        if (request()->wantsJson()){
            return response(['status' => 'Success']);
        }
        return back();
    }
}
