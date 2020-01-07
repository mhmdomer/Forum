@component('profiles.activities.activity')
    @slot('heading')
        Liked reply &nbsp;
        <a style="flex:1;" href="{{ url($activity->subject->favorited->path()) }}" style="text-decoration: none">
            {{ $activity->subject->favorited->body }}
        </a>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->favorited->body }}</p>
    @endslot
@endcomponent
