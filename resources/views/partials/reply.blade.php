<reply :attributes="{{ $reply }}" inline-template>
    <div id="reply-{{ $reply->id }}" class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light mt-4">
        <div class="py-3 px-6 mb-0 bg-grey-lighter border-b-1 border-grey-light text-grey-darkest p-3 pb-0">
            <div style="display: flex;">
                <p class="flex-fill"> <a href="{{ route('profile', $reply->user->name) }}">{{ $reply->user->name }}</a> {{ $reply->created_at->diffForHumans() }}</p>
                <favorite :reply='{{ $reply }}'></favorite>
            </div>
        </div>
        <div class="flex-auto p-6">
            <div v-if='!editing'>
                <p class="ml-2" v-text='body'></p>
                <hr>
                @can('delete', $reply)
                    <button @click='editing = true' class="ml-2 inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight text-teal-lightest bg-teal hover:bg-teal-light">Edit</button>
                    <button style="display:inline" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-red-dark border-red bg-white hover:bg-red-light hover:text-red-darker py-1 px-2 text-sm leading-tight" @click='remove'>Delete</button>
                @endcan
            </div>
            <div class v-if='editing'>
                <div>
                    <textarea class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded" type="text" v-model='body'></textarea>
                </div>
                <hr>
                <button @click='editing = false' class="ml-2 inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline py-1 px-2 text-sm leading-tight font-normal blue bg-transparent">Cancel</button>
                <button style="display:inline" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-blue-dark border-blue bg-white hover:bg-blue-light hover:text-blue-darker py-1 px-2 text-sm leading-tight" @click='save'>Save</button>
            </div>
        </div>
    </div>
</reply>