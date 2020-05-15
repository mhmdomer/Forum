<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
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
        'admin' => 'boolean',
        'locked' => 'boolean'
    ];

    protected $appends = ['image'];

    public function threads() {
        return $this->hasMany(Thread::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function activity() {
        return $this->hasMany(Activity::class);
    }

    public function latestReply() {
        return $this->replies()->latest()->first();
    }

    public function isAdmin() {
        return $this->isAdmin;
    }

    public function makeAdmin() {
        $this->admin = true;
        $this->save();
        return $this;
    }

    public function removeAdmin() {
        $this->admin = false;
        $this->save();
        return $this;
    }

    public function getAvatarAttribute($avatar) {
        if($avatar) {
            return '/storage/' . $avatar;
        }
        return '/images/avatars/default.jpg';
    }

    // for axios calls in vue
    public function getImageAttribute() {
        return $this->avatar;
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
