@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap">
        <div class="md:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest">
                    <div style="display:flex;">
                        <div style="flex:1">
                            <a  href="{{ route('profile', $thread->user->name) }}">
                                {{ $thread->user->name }}
                            </a> posted: {{ $thread->title }}
                        </div>
                        @can('delete', $thread)
                            <form action="{{ route('threads.delete', [$thread->channel, $thread->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="flex-auto p-6">
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
                    <div class="mb-4">
                        <textarea type="date" rows="4" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" name="body" placeholder="Have something to say ?"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-teal-dark border-teal bg-white hover:bg-teal-light hover:text-teal-darker">Post</button>
                    </div>
                </form>
            @else
                <div class="pt-4">
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate on Threads</p>
                </div>
            @endif
        </div>
        <div class="md:w-1/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                <div class="flex-auto p-6">
                    <p>This thread is published {{ $thread->created_at->diffForHumans() }} by <a href="{{ route('profile', $thread->user->name) }}">{{ $thread->user->name }}</a> and 
                    it has {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection