<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use App\Thread;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class ThreadsTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_thread_has_a_path() {
        $thread = create('App\Thread');
        $this->assertEquals($thread->path(), '/threads/' . $thread->channel->slug . '/' . $thread->slug);
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator() {
        $this->assertInstanceOf('App\User', $this->thread->user);
    }

    /** @test */
    public function a_thread_can_add_a_reply() {
        $this->signIn();
        $this->thread->addReply(['user_id' => create('App\User')->id, 'body' => 'Testing']);
        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel() {
        $this->assertInstanceOf('App\Channel', $this->thread->channel);
    }

    /** @test */
    public function a_thread_can_be_subscribed_to_and_unsubscribed_from() {
        $this->signIn();
        $this->thread->subscribe(auth()->id());
        $this->assertCount(1, $this->thread->subscriptions);
        $this->thread->unsubscribe(auth()->id());
        $this->assertCount(0, $this->thread->fresh()->subscriptions);
    }

    /** @test */
    public function a_thread_notifies_all_subscribed_users_when_a_reply_is_added() {
        // Don't send a notification or add it to database, instead fake it and save it locally
        Notification::fake();
        $this->signIn();
        $this->thread->subscribe();
        $this->thread->addReply(['user_id' => 1, 'body' => 'testing']);
        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    /** @test */
    public function a_thread_can_check_if_the_authenticated_user_has_read_all_replies() {
        $this->signIn();
        $user = auth()->user();
        $this->assertTrue($this->thread->hasUpdatesFor($user));
        $user->read($this->thread);
        $this->assertFalse($this->thread->hasUpdatesFor($user));
    }

}
