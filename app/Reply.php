<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favorable, RecordsActivity;

    protected $guarded = [];

    // eager-load user and favorites every time a reply is queried.
    protected $with = ['user', 'favorites'];
    protected $appends   = ['favoriteCount', 'isFavorited'];

    public function thread() {
        return $this->belongsTo('App\Thread');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function activity() {
        return $this->morphMany('App\Activity', 'subject');
    }

    public function path() {
        return $this->thread->path() . '#reply-' . $this->id;
    }

    public function wasJustPublished() {
        return $this->created_at > now()->subSeconds(10);
    }

    public function wasJustUpdated() {
        return $this->updated_at > now()->subSeconds(10)
            && $this->created_at < $this->updated_at;
    }

    public function mentionedUsers() {
        preg_match_all('/@([\w\-]+)/', $this->body, $matches);
        $names = array_unique($matches[1]);
        $index = array_search(auth()->user()->name, $names);
        if($index !== false) {
            unset($names[$index]);
        }
        return User::whereIn('name', $names)->get();
    }

    public function setBodyAttribute($body) {
        $this->attributes['body'] = preg_replace('/@([\w\-]+)/', '<a href="/profiles/$1">$0</a>', $body);
    }

}
