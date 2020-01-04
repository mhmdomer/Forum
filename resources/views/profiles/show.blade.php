@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="mb-5" style="display:flex">
                <h3 class="flex-fill">
                    {{ $userProfile->name }}
                </h3>
                <strong>since {{ $userProfile->created_at->diffForHumans() }}</strong>
            </div>
            @foreach ($userProfile->threads as $thread)
            <div class="card my-4">
                <div class="card-body">
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
        </div>
    </div>
</div>

@endsection