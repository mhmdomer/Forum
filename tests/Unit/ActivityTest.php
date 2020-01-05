<?php

namespace Tests\Unit;

use App\Activity;
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

    
}
