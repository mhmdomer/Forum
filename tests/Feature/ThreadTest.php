<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function user_can_view_threads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }

    /** @test */
    public function user_can_view_single_thread() {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
}
