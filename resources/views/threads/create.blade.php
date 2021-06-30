@extends('layouts.app')

@section('content')

<div class="flex">
    <div class="md:w-2/3 mx-auto">
        @include('partials.errors')
        <form method="POST" action="{{ route('threads.store') }}">
            {{ csrf_field() }}
            <div class="mb-4">
                <label for="channel">Choose a channel</label>
                <select name="channel_id" class="input-field" required>
                    <option value="" selected>Select a Channel</option>
                    @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="title">Title</label>
                <input type="text" name="title" class="input-field" value="{{ old('title') }}" required>
            </div>
            <div class="mb-4">
                <label for="body">Body</label>
                <wysiwyg name="body"></wysiwyg>
                {{-- <input type="hidden" id='body' name="body">
                <trix-editor input="body"></trix-editor> --}}
                {{-- <textarea type="text" name="body" class="input-field" rows="5" required>{{ old('body') }}</textarea> --}}
            </div>
            <div class="mb-4">
                <button type="submit" class="button">Publish</button>
            </div>
        </form>
    </div>
</div>

@endsection
