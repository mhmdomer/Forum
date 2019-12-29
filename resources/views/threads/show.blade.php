@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <a href="#">{{ $thread->user->name }}</a> posted: {{ $thread->title }}
            </div>
            <div class="card-body">
                {{ $thread->body }}
            </div>
        </div>
        <h4 class="mt-4">Replies:</h4>
        @foreach ($thread->replies->reverse() as $reply)
            @include('partials.reply')
        @endforeach
        @if(auth()->check())
            <form method="POST" action="{{ route('replies.store', $thread->id) }}" class="mt-4">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea type="date" rows="4" class="form-control" name="body" placeholder="Have something to say ?"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-info">Post</button>
                </div>
            </form>
        @else
            <div class="pt-4">
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate on Threads</p>
            </div>
        @endif
    </div>
</div>

@endsection