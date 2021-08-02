<?php

namespace App;

use App\Events\ThreadReceivedNewReply;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class Thread extends Model
{

    use RecordsActivity, Favorable;

    protected $guarded = [];

    // eager-load channel every time a thread is queried.
    protected $with = ['channel', 'user'];

    protected $casts = ['id' => 'integer', 'locked' => 'boolean'];

    protected $appends = ['isSubscribed', 'favoriteCount', 'isFavorited'];

    // every thread will have a replies_count attribute with it
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('replyAndFavoriteCount', function (Builder $builder) {
            return $builder->withCount(['replies', 'favorites']);
        });

        static::deleting(function ($thread) {
            $thread->replies->each(function ($reply) {
                $reply->delete();
            });
            $thread->activity()->delete();
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function path()
    {
        return '/threads/' . $this->channel->slug . '/' . $this->slug;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function addReply($attributes)
    {
        $reply = $this->replies()->create($attributes);
        event(new ThreadReceivedNewReply($reply));
        $this->touch();
        return $reply;
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function getIsSubscribedAttribute()
    {
        return $this->subscriptions()->where('user_id', auth()->id())->exists();
    }

    public function hasUpdatesFor($user = null)
    {
        $user = $user ?: auth()->user();
        return cache($user->visitedThreadCacheKey($this)) < $this->updated_at;
    }

    public function setSlugAttribute($value)
    {
        $slug = str_slug($value);
        if (static::whereSlug($slug)->exists()) {
            $slug = "{$slug}-" . $this->id;
        }
        $this->attributes['slug'] = $slug;
    }

    public function getBodyAttribute($body)
    {
        return Purify::clean($body);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
