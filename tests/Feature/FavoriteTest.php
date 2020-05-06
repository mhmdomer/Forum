<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    /** @test */
    public function guest_can_not_favorite_replies() {
        $reply = create('App\Reply');
        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_favorite_replies() {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('/replies/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function authenticated_user_can_not_favorite_a_reply_more_than_once() {
        $this->signIn();
        $this->withoutExceptionHandling();
        $reply = create('App\Reply');
        $this->post('/replies/' . $reply->id . '/favorites');
        $this->post('/replies/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function authenticated_user_can_un_favorite_a_reply() {
        $this->signIn();
        $reply = create('App\Reply');
        $reply->favorite();
        $this->delete('/replies/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->fresh()->favorites);
    }
}
