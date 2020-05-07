<div class="rounded-lg shadow bg-gray-100 mt-4 hover:bg-indigo-100 mx-2">
    <div class="md:p-6 p-3">
        <article>
            <div class='text-gray-800 text-xl'>
                <div class="flex items-start">
                    <img class="w-12 h-12 mr-4 rounded-full" src="/images/avatar{{ rand(0,4) }}.jpg" alt="avatar">
                    <div>
                        <a  href="{{ url($thread->path()) }}">
                            <h3>{{ $thread->title }}</h3>
                            <span class='inline-block text-sm mt-0 text-gray-600'>{{ $thread->created_at->diffForHumans() }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <p class="text-gray-700 md:ml-16 bg-gray-100 rounded-lg p-4">{{ $thread->body }}</p>
            <div class="flex mt-4">
                <div class="md:ml-16 ml-2">
                    <a class="text-xs bg-gray-300 text-gray-700 p-1 rounded-full" href="{{ url($thread->path()) }}"><strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong></a>
                </div> 
                <div class="ml-4">
                    <strong class="text-xs bg-gray-300 text-red-500 p-1 rounded-full">
                        {{ $thread->favorites_count }} {{ str_plural('Love', $thread->favorites_count) }}
                    </strong>
                </div>
                <div class="ml-4">
                    <span class="text-xs bg-gray-300 text-gray-700 p-1 rounded-full">
                        {{ $thread->channel->name }}
                    </span>
                </div>
            </div>
        </article>
    </div>
</div>