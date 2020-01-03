<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];


    // every thread will have a replies_count attribute with it
    protected static function boot() {
        parent::boot();
        static::addGlobalScope('replyCont', function($builder) {
            return $builder->withCount('replies');
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
        return $this->belongsTo('App\Channel');
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
