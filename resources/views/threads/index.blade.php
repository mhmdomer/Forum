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
        <div class="md:w-1/3 md:mx-auto mx-4 mt-6 md:ml-6">
            <h1 class="text-3xl">Trending Threads</h1>
            <div class="bg-indigo-900 text-gray-200 rounded-lg p-2 pt-4">
                @foreach ($trending as $thread)
                    <div class="mb-4">
                        <a href="{{ $thread->path }}">{{ $thread->title }}</a>
                        {{-- <hr></div> --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
