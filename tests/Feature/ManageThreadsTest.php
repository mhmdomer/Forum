<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageThreadsTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = make('App\Thread');
    }

    /** @test */
    public function authenticated_user_may_create_threads()
    {
        $this->signIn();
        $response = $this->post('threads', $this->thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->get('threads/create')->assertRedirect('/login');
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('threads', $this->thread->toArray());
    }

    /** @test */
    public function thread_requires_valid_title()
    {
        $this->withExceptionHandling();
        $this->publishThread(['title' => null])->assertSessionHasErrors('title');;
    }

    /** @test */
    public function thread_requires_valid_body()
    {
        $this->publishThread(['body' => null])->assertSessionHasErrors('body');;
    }

    /** @test */
    public function thread_requires_valid_channel()
    {
        $this->publishThread(['channel_id' => 99])->assertSessionHasErrors('channel_id');
    }

    /** @test */
    public function authorized_users_can_delete_threads() {
        $user = create('App\User');
        $this->signIn($user);
        $thread = create('App\Thread', ['user_id' => $user->id]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);
        $this->delete($thread->path())
            ->assertRedirect('/threads');
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    /** @test */
    public function unauthorized_users_can_not_delete_threads() {
        $thread = create('App\Thread');
        $this->delete($thread->path())
            ->assertRedirect('/login');
        $this->assertDatabaseHas('threads', ['id' => $thread->id]);
        $this->signIn();
        $this->delete($thread->path())
            ->assertStatus(403);
    }

    public function publishThread($attributes)
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $attributes);
        return $this->post('threads', $thread->toArray());
    }
}
