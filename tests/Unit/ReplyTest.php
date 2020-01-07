<?php

namespace Tests\Unit;

use Tests\TestCase;

class ReplyTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->reply = create('App\Reply');
    }

    /** @test */
    public function a_reply_belongs_to_a_user_and_a_thread()
    {
        $this->assertInstanceOf('App\User', $this->reply->user);
        $this->assertInstanceOf('App\Thread', $this->reply->thread);
    }

}
