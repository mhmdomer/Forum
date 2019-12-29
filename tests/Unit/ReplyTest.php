<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{

    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->reply = create('App\Reply');
    }

    /** @test */
    public function a_reply_belongs_to_a_user()
    {
        $this->assertInstanceOf('App\User', $this->reply->user);
    }
}
