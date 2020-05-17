<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Filters\ThreadFilters;
use App\Rules\SpamFree;
use App\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);
        if(request()->wantsJson()) return $threads;
        return view('threads.index')->with([
            'threads' => $threads,
            'trending' => $trending->get()
        ]);
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
        $data = request()->validate([
            'title' => ["required","min:4", "max:100", new SpamFree],
            'body' => ["required","min:4", "max:1000", new SpamFree],
            'channel_id' => "required|exists:channels,id"
        ]);
        $thread = Thread::create(
            array_merge($data, [
                'user_id' => auth()->id(),
                'slug' => str_slug($request['title'])
                ]
            )
        );
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, $thread, Trending $trending)
    {
        $thread = Thread::whereSlug($thread)->firstOrFail();
        if (auth()->check()) {
            auth()->user()->read($thread);
        }
        $thread->increment('visits');
        $trending->push($thread);
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
    public function update(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);
        $data = request()->validate([
            'title' => ["required","min:4", "max:100", new SpamFree],
            'body' => ["required","min:4", "max:6000", new SpamFree],
        ]);
        $thread->update($data);
        return $thread;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, $thread)
    {
        $thread = Thread::whereSlug($thread)->firstOrFail();
        $this->authorize('delete', $thread);
        $thread->delete();
        return redirect()->route('threads.index');
    }

    private function getThreads($channel = null, $filters) {
        $threads = Thread::latest()->filter($filters);
        if ($channel->exists) {
            $threads = $threads->where('channel_id', $channel->id);
        }
        $threads = $threads->paginate(10);
        return $threads;
    }
}
