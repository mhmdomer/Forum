<div class="rounded-lg shadow bg-gray-100 mt-4 hover:bg-indigo-100 mx-2">
    <div class="md:p-6 p-3">
        <article>
            <div class='text-gray-800 text-xl'>
                <div class="flex items-start">
                    <img class="w-12 h-12 mr-4 rounded-full" src="{{ $thread->user->avatar }}" alt="avatar">
                    <div>
                        <a  href="{{ url($thread->path()) }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                            <strong><h3>{{ $thread->title }}</h3></strong>
                            @else
                            <h3>{{ $thread->title }}</h3>
                            @endif
                        </a>
                        <span class="text-sm font-semibold">
                            Posted By <a href="{{ route('profile', $thread->user->name) }}">{{ $thread->user->name }}</a>
                        </span>
                        <span class='inline-block text-sm mt-0 text-gray-600'>
                            {{ $thread->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <div class="ml-auto">
                        <span class="text-sm rounded-lg bg-gray-300 p-1">
                            {{ $thread->channel->name }}
                        </span>
                    </div>
                </div>
            </div>
            <p class="text-gray-700 md:ml-16 bg-gray-100 rounded-lg p-4">{{ $thread->body }}</p>
            <div class="flex mt-4">
                <div class="md:ml-16 ml-2">
                    <a class="text-xs bg-gray-300 text-gray-700 p-1 rounded-full" href="{{ url($thread->path()) }}"><strong>{{ number_format($thread->replies_count) }} <i class="fa fa-comment"></i></strong></a>
                </div>
                <div class="ml-4">
                    <strong class="text-xs bg-gray-300 text-red-500 p-1 rounded-full">
                        {{ number_format($thread->favorites_count) }} <i class="fa fa-heart"></i>
                    </strong>
                </div>
                <div class="text-xs bg-gray-300 ml-4 p-1 rounded-full">
                    <strong>{{ number_format($thread->visits()->count()) }} Visits</strong>
                </div>
            </div>
        </article>
    </div>
</div>
