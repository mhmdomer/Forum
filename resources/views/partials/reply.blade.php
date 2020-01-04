<div class="card mt-4">
    <div class="card-header p-3 pb-0">
        <div style="display: flex;">
            <p class="flex-fill"> <a href="#">{{ $reply->user->name }}</a> {{ $reply->created_at->diffForHumans() }}</p>
            <form method="POST" action="{{ route('reply.favorite', $reply->id) }}">
                {{ csrf_field() }}
                <button class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                    {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                </button>
            </form>
        </div>
    </div>
    <div class="p-3 pb-0" style="padding:0; margin:0">
        <p class="m-0">{{ $reply->body }}</p>
    </div>
    <hr>
</div>