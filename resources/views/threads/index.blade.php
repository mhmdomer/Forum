@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap">
        <div class="md:w-2/3 pr-4 pl-4 md:mx-1/5">
            <h3>Forum Threads</h3>
            @foreach ($threads as $thread)
                <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light my-4">
                    <div class="flex-auto p-6">
                        <article>
                            <div style="display: flex; justify-content:center;">
                                <a style="flex:1;" class='' href="{{ url($thread->path()) }}" style="text-decoration: none">
                                    <h3>{{ $thread->title }}</h3>
                                </a>
                                <a href="{{ url($thread->path()) }}"><strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong></a>
                            </div>
                            <hr>
                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                            <p>{{ $thread->body }}</p>
                        </article>
                    </div>
                </div>
            @endforeach
            @if(Auth::guest())
                <div class="pt-4">
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to create Threads</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection