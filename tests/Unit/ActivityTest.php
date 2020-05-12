<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;

class ActivityTest extends TestCase
{

    /** @test */
    public function is_recorded_when_a_thread_is_created() {
        $this->signIn();
        $thread = create('App\Thread');
        $this->assertDatabaseHas('activities', [
            'subject_id' => $thread->id,
            'user_id' => auth()->id(),
            'subject_type' => 'App\Thread'
        ]);
        $activity = Activity::first();
        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function is_recorded_when_a_reply_is_created() {
        $this->signIn();
        $reply = create('App\Reply');
        $this->assertDatabaseHas('activities', [
            'subject_id' => $reply->id,
            'user_id' => auth()->id(),
            'subject_type' => get_class($reply)
        ]);
        $this->assertEquals(2, Activity::count());
    }

    /** @test */
    public function is_recorded_when_a_reply_is_favorited() {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post("replies/{$reply->id}/favorites");
        $this->assertDatabaseHas('activities', [
            'subject_type' => 'App\Favorite'
        ]);
        $this->assertEquals(3, Activity::count());
    }

    /** @test */
    public function it_fetches_the_feed_of_any_user() {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()], 2)->first();
        $reply = create('App\Reply', ['user_id' => auth()->id(), 'thread_id' => $thread->id]);
        $this->post("replies/{$reply->id}/favorites");
        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);
        $feed = Activity::feed(auth()->user());
        $this->assertTrue($feed->keys()->contains(Carbon::now()->format('Y-m-d')));
        $this->assertTrue($feed->keys()->contains(Carbon::now()->subWeek()->format('Y-m-d')));
        $this->assertCount(4, Activity::all());
    }
}
