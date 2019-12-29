<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->thread = create('App\Thread');
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
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);
        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);

    }


}
