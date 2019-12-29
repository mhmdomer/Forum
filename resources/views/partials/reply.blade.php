<div class="card mt-4">
    <div class="card-header p-3 pb-0">
        <p> <a href="#">{{ $reply->user->name }}</a> {{ $reply->created_at->diffForHumans() }}</p>
    </div>
    <div class="p-3 pb-0" style="padding:0; margin:0">
        <p class="m-0">{{ $reply->body }}</p>
    </div>
    <hr>
</div>