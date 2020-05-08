<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->thread = create('App\Thread');
    }

    /** @test */
    public function user_can_view_threads()
    {
        $this->get('/threads')->assertSee($this->thread->title);
    }

    /** @test */
    public function user_can_view_single_thread()
    {
        $this->get($this->thread->path())->assertSee($this->thread->title);
    }

    /** @test */
    public function user_can_see_thread_replies()
    {
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $reply->body]);
    }

    /** @test */
    public function user_can_filter_threads_by_channel()
    {
        $this->withoutExceptionHandling();
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');
        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */

    public function user_can_filter_see_unanswered_threads() {
        $withoutAnswers = create('App\Thread');
        $withAnswers = create('App\Thread');
        create('App\Reply', ['thread_id' => $withAnswers->id]);
        $this->get('/threads?unanswered=1')
            ->assertSee($withoutAnswers->body)
            ->assertDontSee($withAnswers->body);
    }

    /** @test */
    public function user_can_see_his_own_threads()
    {
        $this->signIn(create('App\User', ['name' => 'John Doe']));
        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');
        $this->get('threads?by=' . auth()->user()->name)
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function user_can_filter_threads_by_popularity() {
        $threadWithTwoReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);
        $threadWithThreeReplies = create('App\Thread');
        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);
        $threadWithNoReplies = $this->thread;
        $response = $this->getJson('/threads?popular')->json();
        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }
}
