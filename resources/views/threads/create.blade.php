@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="">
        <div class="md:w-2/3 pr-4 pl-4 md:mx-1/5">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light p-3">
                <h3>Create a Thread:</h3>
                <form method="POST" action="{{ route('threads.store') }}">
                    {{ csrf_field() }}
                    <div class="mb-4">
                        <label for="channel">Choose a channel</label>
                        <select name="channel_id" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" required>
                            <option value="" selected>Select a Channel</option>
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="body">Body</label>
                        <textarea type="text" name="body" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" rows="5" required>{{ old('body') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-teal-dark border-teal bg-white hover:bg-teal-light hover:text-teal-darker">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection