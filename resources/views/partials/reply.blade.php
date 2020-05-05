<reply :attributes="{{ $reply }}" inline-template>
    <div id="reply-{{ $reply->id }}" class="bg-white p-4 rounded">
        <div class="text-gray-800 text-lg">
            <div class="flex items-start">
                <div>
                    <img src="/images/avatar{{ rand(0,4) }}.jpg" class="inline w-12 h-12 mr-4 rounded-full" alt="avatar">
                    <a class="" href="{{ route('profile', $reply->user->name) }}">{{ $reply->user->name }}</a>
                    <span class='inline-block text-sm mt-0 text-gray-600'>{{ $reply->created_at->diffForHumans() }}</span>
                </div>
                <favorite :reply='{{ $reply }}' class="ml-auto"></favorite>
            </div>
        </div>
        <div class="">
            <div v-if='!editing'>
                <p class="text-gray-700 md:ml-10 bg-gray-100 rounded-lg p-4" v-text='body'></p>
                @can('delete', $reply)
                <div class="md:ml-10 mt-2">
                    <button @click='editing = true' class="rounded bg-gray-600 text-white px-3">Edit</button>
                    <button style="display:inline" class="rounded bg-red-500 text-white px-3" @click='remove'>Delete</button>
                </div>
                @endcan
            </div>
            <div class v-if='editing'>
                <div class="md:ml-10 mt-2">
                    <textarea class="appearance-none block w-full bg-gray-300 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight" class="form-control" v-model='body'></textarea>
                </div>
                <div class="md:ml-10 mt-2">
                    <button @click='editing = false' class="rounded bg-gray-600 text-white px-3">Cancel</button>
                    <button style="display:inline" class="rounded bg-green-500 text-white px-3" @click='save'>Save</button>
                </div>
            </div>
        </div>
    </div>
</reply>
