<?php

namespace Tests\Feature;

use Tests\TestCase;

class LockThreadsTest extends TestCase {


    /** @test */
    public function an_administrator_can_lock_threads() {
        $this->withoutExceptionHandling();
        $user = create('App\User', ['admin' => true]);
        $this->signIn($user);
        $thread = create('App\Thread');
        $this->assertFalse($thread->locked);
        $this->post('/threads/' . $thread->slug . '/lock')->assertStatus(200);
        $this->assertTrue($thread->fresh()->locked);
    }

    /** @test */
    public function an_administrator_can_unlock_threads() {
        $this->withoutExceptionHandling();
        $user = create('App\User', ['admin' => true]);
        $this->signIn($user);
        $thread = create('App\Thread', ['locked' => true]);
        $this->assertTrue($thread->locked);
        $this->post('/threads/' . $thread->slug . '/unlock')->assertStatus(200);
        $this->assertFalse($thread->fresh()->locked);
    }

    /** @test */
    public function regular_users_cannot_lock_or_unlock_threads() {
        $user = create('App\User');
        $thread = create('App\Thread', ['user_id' => $user->id]);
        $this->signIn($user);
        $this->post('/threads/' . $thread->slug . '/lock')->assertStatus(403);
        $this->post('/threads/' . $thread->slug . '/unlock')->assertStatus(403);
    }

    /** @test */
    public function locked_threads_dont_accept_replies() {
        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['user_id', auth()->id()]);
        $thread->update(['locked' => true]);
        $this->postJson($thread->path(). '/replies', $reply->toArray())->assertStatus(403);
    }

}
