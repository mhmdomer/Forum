<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReplyTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->reply = create('App\Reply');
    }

    /** @test */
    public function a_reply_can_be_deleted_by_authorized_user()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        $this->delete('replies/' . $reply->id)
            ->assertStatus(200);
    }

    /** @test */
    public function a_reply_can_not_be_deleted_by_unauthorized_user()
    {
        $reply = create('App\Reply');
        $this->delete('replies/' . $reply->id)->assertRedirect('/login');
        $this->signIn();
        $this->delete('replies/' . $reply->id)
            ->assertStatus(403);
    }

    /** @test */
    public function a_reply_can_not_be_updated_by_unauthorized_user()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');
        $this->signIn();
        $reply = create('App\Reply');
        $this->patch('replies/' . $reply->id, ['body' => 'new body'])
            ->assertStatus(403);
    }

    /** @test */
    public function a_reply_can_be_updated_by_authorized_user()
    {
        $this->signIn();
        $reply = create('App\Reply', ['user_id' => auth()->id()]);
        $body = 'new body';
        $this->patch('replies/' . $reply->id, ['body' => $body])
            ->assertStatus(200);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $body]);
    }

    /** @test */
    public function a_user_cannot_reply_more_than_once_every_ten_seconds() {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['user_id' => auth()->id()]);
        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertStatus(201);
        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertStatus(403);
    }

}
