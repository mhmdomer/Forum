<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    public function thread() {
        return $this->belongsTo('App\Thread');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite() {
        if(! $this->favorites()->where('user_id', auth()->id())->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }
}
