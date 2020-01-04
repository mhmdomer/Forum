@extends('layouts.app')

@section('content')

<div class="container">
    <div class="mb-5" style="display:flex">
        <h3 class="flex-fill">
            {{ $userProfile->name }}
        </h3>
        <strong>since {{ $userProfile->created_at->diffForHumans() }}</strong>
    </div>
    <hr>
    @foreach ($userProfile->threads as $thread)
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

@endsection