<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    
    public function setUp() :void {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->thread = create('App\Thread');
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
}
