<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->reply = make('App\Reply');
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function authenticated_user_may_add_replies()
    {
        $this->signIn();
        $response = $this->post($this->thread->path() . '/replies', $this->reply->toArray());
        $this->get($this->thread->path())->assertSee($this->reply->body);
    }

    /** @test */
    public function guests_may_not_add_replies() {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $response = $this->post($this->thread->path() . '/replies', $this->reply->toArray());
    }

    /** @test */
    public function reply_requires_valid_body() {
        $this->withExceptionHandling()->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);
        $this->post($thread->path() . '/' . 'replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
