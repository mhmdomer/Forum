<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function threads() {
        return $this->hasMany('App\Thread');
    }

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function activity() {
        return $this->hasMany('App\Activity');
    }

    // for route model binding
    public function getRouteKeyName() {
        return 'name';
    }

    public function visitedThreadCacheKey($thread) {
        return sprintf("users.%s.visited.%s", auth()->id(), $thread->id);
    }

    public function read(Thread $thread) {
        cache()->forever($this->visitedThreadCacheKey($thread), Carbon::now());
    }
}
