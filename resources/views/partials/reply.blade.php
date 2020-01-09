<reply :attributes="{{ $reply }}" inline-template>
    <div id="reply-{{ $reply->id }}" class="card mt-4">
        <div class="card-header p-3 pb-0">
            <div style="display: flex;">
                <p class="flex-fill"> <a href="{{ route('profile', $reply->user->name) }}">{{ $reply->user->name }}</a> {{ $reply->created_at->diffForHumans() }}</p>
                <form method="POST" action="{{ route('reply.favorite', $reply->id) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form> 
            </div>
        </div>
        <div class="card-body">
            <div v-if='!editing'>
                <p class="ml-2" v-text='body'></p>
                <hr>
                @can('delete', $reply)
                    <button @click='editing = true' class="ml-2 btn btn-sm btn-info">Edit</button>
                    <button style="display:inline" class="btn btn-outline-danger btn-sm" @click='remove'>Delete</button>
                @endcan
            </div>
            <div class v-if='editing'>
                <div>
                    <textarea class="form-control" type="text" v-model='body'></textarea>
                </div>
                <hr>
                <button @click='editing = false' class="ml-2 btn btn-sm btn-link">Cancel</button>
                <button style="display:inline" class="btn btn-outline-primary btn-sm" @click='save'>Save</button>
            </div>
        </div>
    </div>
</reply>