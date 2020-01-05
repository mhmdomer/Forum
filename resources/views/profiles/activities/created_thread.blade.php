@component('profiles.activities.activity')
    @slot('heading')
    Created thread &nbsp;
    <a style="flex:1;" class='' href="{{ '#' }}" style="text-decoration: none">
        {{ $activity->subject->title }}
    </a>
    @endslot
    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent
