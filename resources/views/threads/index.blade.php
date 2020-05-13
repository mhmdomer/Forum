@extends('layouts.app')

@section('content')

<div class="mx-auto">
    <div class="md:flex md:mx-12">
        <div class="md:w-2/3 md:mx-auto sm:mx-12 mx-4">
            <h1 class="text-3xl">Forum Threads</h1>
            @foreach ($threads as $thread)
            @include('partials.thread', $thread)
            @endforeach
            <div class="mt-4">
                {{ $threads->links('vendor.pagination.default') }}
            </div>
            @if(Auth::guest())
            <div class="pt-4">
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to create Threads</p>
            </div>
            @endif
        </div>
        <div class="md:w-1/3 md:mx-auto mx-4 mt-3 md:ml-6">
            @if (count($trending))
            <h1 class="text-3xl">Trending Threads</h1>
            <div class="bg-gray-100 mt-1 text-indigo-500 rounded-lg p-2 pt-4 border-2">
                @foreach ($trending as $thread)
                    <div class="mb-4 trending-thread">
                        <a href="{{ $thread->path }}">{{ $thread->title }}</a>
                        <hr class="mt-4 divider">
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
