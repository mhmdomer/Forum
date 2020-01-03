@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3>Forum Threads</h3>
                    <hr>
                    @foreach ($threads as $thread)
                        <article>
                            <div style="display: flex; justify-content:center;">
                                <a style="flex:1;" class='' href="{{ url($thread->path()) }}" style="text-decoration: none">
                                    <h3>{{ $thread->title }}</h3>
                                </a>
                                <a href="{{ url($thread->path()) }}"><strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong></a>
                            </div>
                            <span>{{ $thread->created_at->diffForHumans() }}</span>
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