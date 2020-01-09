<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReplyTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
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
        $this->expectException('Illuminate\Auth\Access\AuthorizationException');
        $this->signIn();
        $reply = create('App\Reply');
        $this->delete('replies/' . $reply->id)
            ->assertStatus(403);
    }

    /** @test */
    public function a_reply_can_not_be_updated_by_unauthorized_user()
    {
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

}
