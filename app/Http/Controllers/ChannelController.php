<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Thread;

class ChannelController extends Controller
{
    public function __construct() {
        // $this->middleware('auth');
    }

    public function show(Channel $channel) {
        // $channel = Channel::where('slug', $channel)->first();
        $threads = Thread::where('channel_id', $channel->id)->get();
        return view('channels.show')->with(['threads' => $threads, 'channel' => $channel]);
    }
}
