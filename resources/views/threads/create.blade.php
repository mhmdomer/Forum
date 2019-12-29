@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card p-3">
                <h3>Create a Thread:</h3>
                <form method="POST" action="{{ route('threads.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">Body</label>
                        <textarea type="text" name="body" class="form-control" rows="5"></textarea>
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