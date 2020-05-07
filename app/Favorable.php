<?php

namespace App;

trait Favorable
{

    protected static function bootFavorable() {
        static::deleting(function($model) {
            $model->favorites->each->delete();
        });
    }
    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite() {
        if(! $this->favorites()->where('user_id', auth()->id())->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }

    public function unFavorite() {
        if($this->favorites()->where('user_id', auth()->id())->exists()) {
            return $this->favorites()->get()->each->delete();
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
