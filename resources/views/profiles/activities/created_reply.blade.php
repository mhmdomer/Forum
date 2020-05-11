@component('profiles.activities.activity')
    @slot('heading')
        Replied to a thread &nbsp;
        <a style="flex:1;" href="{{ url($activity->subject->thread->path()) }}" style="text-decoration: none">
            {!! $activity->subject->thread->title !!}
        </a>
    @endslot
    @slot('body')
        <p>{!! $activity->subject->body !!}</p>
    @endslot
@endcomponent
