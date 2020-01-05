@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="mb-5">
                <h3>
                    {{ $userProfile->name }}
                </h3>
            </div>
            @foreach ($activities as $day => $feeds)
                <h3>{{ $day }}</h3>
                @foreach ($feeds as $feed)
                    @include("profiles.activities.{$feed->type}", ['activity' => $feed])
                @endforeach
            @endforeach
        </div>
    </div>
</div>

@endsection