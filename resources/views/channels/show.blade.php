@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap">
        <div class="md:w-2/3 pr-4 pl-4 md:mx-1/5">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                <div class="flex-auto p-6">
                    <h3>{{ $channel->name }} Threads</h3>
                    <hr>
                    @foreach ($threads as $thread)
                        <article>
                            <a class='' href="{{ url($thread->path()) }}" style="text-decoration: none">
                                <h3>{{ $thread->title }}</h3>
                            </a>
                            <p>{{ $thread->body }}</p>
                        </article>
                        <hr>
                    @endforeach
                </div>
            </div>
            @if(Auth::guest())
                <div class="pt-4">
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to create Threads</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection