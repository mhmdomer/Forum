@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="">
        <div class="relative">
            <div class="hidden md:block md:w-1/6 m-6 rounded p-6 sticky top-0">
                <button class="mx-auto px-8 py-2 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-500">New Thread</button>
                <div class="text-center mt-4">
                    <ul>
                        <li class="my-2 "><a class="inline-block px-8 py-1 w-full hover:border hover:text-indigo-400 rounded hover:bg-gray-200" href="">All Threads</a></li>
                        <li><a href="">My Threads</a></li>
                        <li><a href="">Most Popular</a></li>
                        <li><a href="">All Threads</a></li>
                    </ul>
                </div>
            </div>
            <div class="md:w-2/3 mx-auto">
                <h1 class="text-3xl">Forum Threads</h1>
                @foreach ($threads as $thread)
                    @include('partials.thread', $thread)
                @endforeach
                @if(Auth::guest())
                    <div class="pt-4">
                        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to create Threads</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection