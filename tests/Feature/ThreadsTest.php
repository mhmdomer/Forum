<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThreadsTest extends TestCase
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
    public function a_user_should_verify_his_email_before_adding_a_thread() {
        $this->signIn();
        $thread = make('App\Thread');
        $this->postJson('/threads', $thread->toArray())
            ->assertRedirect();
        auth()->user()->email_verified_at = null;
        auth()->user()->save();
        $this->postJson('/threads', make('App\Thread')->toArray())
            ->assertStatus(403);
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
    public function a_thread_can_be_updated() {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->user()]);
        $this->patch($thread->path(), ['title' => 'title', 'body' => 'body'])
            ->assertStatus(200);
        $this->assertEquals($thread->fresh()->body, 'body');
        $this->assertEquals($thread->fresh()->title, 'title');
    }

    /** @test */
    public function unauthorized_users_may_not_update_threads() {
        $this->signIn();
        $thread = create('App\Thread');
        $this->patch($thread->path(), ['body' => 'new body', 'title' => 'title'])
            ->assertStatus(403);
    }

    /** @test */
    public function authorized_users_may_update_threads() {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->patch($thread->path(), ['body' => 'new body', 'title' => 'title'])
            ->assertStatus(200);
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
        $this->assertDatabaseMissing('activities', [
            'subject_type' => get_class($thread),
            'subject_id' => $thread->id
        ]);
        $this->assertDatabaseMissing('activities', [
            'subject_type' => get_class($reply),
            'subject_id' => $reply->id
        ]);
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
