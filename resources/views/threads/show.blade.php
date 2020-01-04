@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('profile', $thread->user->name) }}">{{ $thread->user->name }}</a> posted: {{ $thread->title }}
                </div>
                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <h4 class="mt-4">Replies:</h4>
            @foreach ($replies as $reply)
                @include('partials.reply')
            @endforeach
            <div class="mt-2">
                {{ $replies->links() }}
            </div>
            @if(auth()->check())
                <form method="POST" action="{{ url($thread->path() . '/replies') }}" class="mt-4">
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>This thread is published {{ $thread->created_at->diffForHumans() }} by <a href="{{ route('profile', $thread->user->name) }}">{{ $thread->user->name }}</a> and 
                    it has {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection