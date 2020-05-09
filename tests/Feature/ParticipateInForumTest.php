<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function authenticated_user_may_add_replies()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post($this->thread->path() . '/replies', $reply->toArray());
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $reply->body]);
    }

    /** @test */
    public function guests_may_not_add_replies() {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $reply = create('App\Reply');
        $this->post($this->thread->path() . '/replies', $reply->toArray());
    }

    /** @test */
    public function reply_requires_valid_body() {
        $this->withExceptionHandling()->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);
        $this->post($thread->path() . '/' . 'replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function replies_that_contains_spam_may_not_be_created() {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => 'yahoo customer support']);
        $this->expectException(Exception::class);
        $this->post($thread->path() . '/replies', $reply->toArray());
    }
}
