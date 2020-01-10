<?php

namespace App;

trait Favorable
{
    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite() {
        if(! $this->favorites()->where('user_id', auth()->id())->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }

    public function isFavorited() {
        return $this->favorites->where('user_id',auth()->id())->count();
    }

    public function getFavoriteCountAttribute() {
        return $this->favorites->count();
    }

    public function getIsFavoritedAttribute() {
        return $this->favorites->where('user_id',auth()->id())->count();
    }
}