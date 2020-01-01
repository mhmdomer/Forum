@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card p-3">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
                <h3>Create a Thread:</h3>
                <form method="POST" action="{{ route('threads.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="channel">Choose a channel</label>
                        <select name="channel_id" class="form-control">
                            <option value="" selected>Select a Channel</option>
                            @foreach ($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea type="text" name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-info">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection