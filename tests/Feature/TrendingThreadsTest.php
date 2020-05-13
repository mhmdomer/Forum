<?php

namespace Tests\Feature;

use App\Trending;
use Tests\TestCase;

class TrendingThreadsTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->trending = new Trending();
        $this->trending->reset();
    }

    /** @test */
    public function it_increments_the_thread_score_each_time_it_is_visited() {
        $this->assertEmpty($this->trending->get());
        $thread = create('App\Thread');
        $this->get($thread->path());
        $this->assertCount(1, $data = $this->trending->get());
        $this->assertEquals($thread->title, $data[0]->title);
    }
}
