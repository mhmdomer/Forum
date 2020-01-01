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
        $response = $this->post('threads', $this->thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function guests_may_not_create_threads() {
        $this->get('threads/create')->assertRedirect('/login');
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads', $this->thread->toArray());
    }

    /** @test */
    public function thread_requires_valid_title() {
        $this->withExceptionHandling();
        $this->publishThread(['title' => null])->assertSessionHasErrors('title');;
    }

    /** @test */
    public function thread_requires_valid_body() {
        $this->publishThread(['body' => null])->assertSessionHasErrors('body');;
    }

    /** @test */
    public function thread_requires_valid_channel() {
        $this->publishThread(['channel_id' => 99])->assertSessionHasErrors('channel_id');
    }

    public function publishThread($attributes) {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $attributes);
        return $this->post('threads', $thread->toArray());
    }



}
