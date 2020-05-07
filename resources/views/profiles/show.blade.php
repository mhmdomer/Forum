@extends('layouts.app')

@section('content')

<div class="flex">
    <div class="md:w-2/3 mx-auto">
        <div class="text-xl mb-6">
            <h3>
                {{ $userProfile->name }}
            </h3>
        </div>
        @forelse($activities as $day => $feeds)
            <h3 class="text-xl">{{ $day }}</h3>
            @foreach ($feeds as $feed)
                @if (view()->exists("profiles.activities.{$feed->type}"))
                    @include("profiles.activities.{$feed->type}", ['activity' => $feed])
                @endif
            @endforeach
        @empty
            <div class="text-center mt-8">
                No activity for this user yet !
            </div>
        @endforelse
    </div>
</div>

@endsection
