@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                {{ $thread->title }}
            </div>
            <div class="card-body">
                {{ $thread->body }}
            </div>
        </div>
        <h3 class="mt-2">Replies:</h3>
        @foreach ($thread->replies as $reply)
            <div class="card m-3">
                <div class="card-header">
                    <p> <a href="#">{{ $reply->user->name }}</a> {{ $reply->created_at->diffForHumans() }}</p>
                </div>
                <div class="card-body">
                    <p>{{ $reply->body }}</p>
                </div>
                <hr>
            </div>
        @endforeach
    </div>
</div>

@endsection