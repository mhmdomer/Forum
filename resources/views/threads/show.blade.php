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
        <div class="card card-body">
            @foreach ($thread->replies as $reply)
                <p>{{ $reply->body }}</p>
                <hr>
            @endforeach
        </div>
    </div>
</div>

@endsection