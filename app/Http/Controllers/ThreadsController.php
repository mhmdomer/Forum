<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\User;
use App\Filters\ThreadFilters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);
        // for tests
        if(request()->wantsJson()) return $threads;
        return view('threads.index')->with(['threads' => $threads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => "required|min:4|max:100",
            'body' => "required|min:4|max:500",
            'channel_id' => "required|exists:channels,id"
        ]);
        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => $request['channel_id'],
            'title' => $request['title'],
            'body' => $request['body']
        ]);
        Session::flash('message', 'Thread created successfully');
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        // $replies = $thread->replies()->latest()->paginate(20);
        return view('threads.show')->with(['thread' => $thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        return redirect()->route('threads.index');
    }

    private function getThreads($channel = null, $filters) {
        $threads = Thread::latest()->filter($filters);
        if ($channel->exists) {
            $threads = $threads->where('channel_id', $channel->id);
        }
        $threads = $threads->get();
        return $threads;
    }
}
