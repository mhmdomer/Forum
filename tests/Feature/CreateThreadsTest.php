<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->thread = make('App\Thread');
    }

    /** @test */
    public function authenticated_user_may_create_threads() {
        $this->signIn();
        $this->post('threads', $this->thread->toArray());
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function guests_may_not_create_threads() {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads', $this->thread->toArray());
    }

    /** @test */
    public function guests_cannot_see_create_thread_page() {
        $this->get('threads/create')->assertRedirect('/login');
    }
}
