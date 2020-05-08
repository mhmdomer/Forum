<?php

namespace Tests\Feature;

use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{

    /** @test */
    public function a_user_can_subscribe_to_threads() {
        $this->signIn();
        $thread = create('App\Thread');
        $this->withoutExceptionHandling();
        $this->post($thread->path() . '/subscriptions');
        $this->assertCount(1, $thread->subscriptions);
    }

}