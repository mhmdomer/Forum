<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

    use RecordsActivity;

    protected $guarded = [];

    // eager-load channel every time a thread is queried.
    protected $with = ['channel', 'user'];

    // every thread will have a replies_count attribute with it
    protected static function boot() {
        parent::boot();
        static::addGlobalScope('replyAndFavoriteCount', function($builder) {
            return $builder->withCount(['replies', 'favorites']);
        });

        static::deleting(function($thread) {
            $thread->replies->each(function($reply) {
                $reply->delete();
            });
            $thread->activity()->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function path()
    {
        return 'threads/' . $this->channel->slug . '/' . $this->id;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function subscriptions() {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribe($userId = null) {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    public function unsubscribe($userId = null) {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->first()->delete();
    }
}
