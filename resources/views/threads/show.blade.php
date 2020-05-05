@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="lg:flex lg:mx-12">
        <div class="lg:w-2/3 mx-4 lg-mx-8">
            @include('partials.thread')
            <h4 class="mt-4 text-xl md:ml-4">Replies:</h4>
            <div class="md:mx-12 mx-2 md:mt-6 mt-2">
                @foreach ($replies as $reply)
                    <div class="md:mb-10 mb-4">
                        @include('partials.reply')
                    </div>
                    <div class="mt-2">
                        {{ $replies->links() }}
                    </div>
                @endforeach
                @if(auth()->check())
                    <form method="POST" action="{{ url($thread->path() . '/replies') }}" class="mt-4">
                        {{ csrf_field() }}
                        <div class="mb-4">
                            <textarea type="date" rows="4" class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" name="body" placeholder="Have something to say ?"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="button">Post</button>
                        </div>
                    </form>
                @else
                    <div class="pt-4">
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate on Threads</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="lg:w-1/3">
            <div class="bg-white mt-4 p-4 rounded text-md">
                <p>This thread is published {{ $thread->created_at->diffForHumans() }} by <a href="{{ route('profile', $thread->user->name) }}" class="text-purple-700">{{ $thread->user->name }}</a> and
                it has {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
