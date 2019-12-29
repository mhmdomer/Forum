<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() :void {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function user_can_view_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test */
    public function user_can_view_single_thread() {
        $this->get('/threads/' . $this->thread->id)->assertSee($this->thread->title);
    }

    /** @test */
    public function user_can_see_thread_replies() {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);

    }


}
