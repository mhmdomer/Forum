@extends('layouts.app')

@section('content')

<div class="mx-auto">
    <div class="md:flex">
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
    </div>
</div>

@endsection
