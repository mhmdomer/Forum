<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class TrendingThreadsTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        Redis::del('trending_threads');
    }

    /** @test */
    public function it_increments_the_thread_score_each_time_it_is_visited() {
        $this->withExceptionHandling();
        $this->assertEmpty(Redis::zrevrange('trending_threads', 0, -1));
        $thread = create('App\Thread');
        $this->get($thread->path());
        $this->assertCount(1, $data = Redis::zrevrange('trending_threads', 0, -1));
        $this->assertEquals($thread->title, json_decode($data[0])->title);
        Redis::save();
    }
}
