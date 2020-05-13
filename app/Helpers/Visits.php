<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

class Visits
{

    protected $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function record() {
        Redis::incr($this->cacheKey());
    }

    public function count() {
        return Redis::get("thread.{$this->thread->id}.visits");
    }

    public function reset() {
        Redis::del($this->cacheKey());
    }


    public function cacheKey() {
        return "thread.{$this->thread->id}.visits";
    }
}
