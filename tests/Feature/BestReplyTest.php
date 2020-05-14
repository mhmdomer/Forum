<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BestReplyTest extends TestCase {

    public function setUp() :void{
        parent::setUp();
    }

    /** @test */
    public function a_thread_creator_can_mark_any_reply_as_best() {
        $this->withoutExceptionHandling();
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $replies = create('App\Reply', ['thread_id' => $thread->id], 2);
        $this->postJson("/replies/{$replies[0]->id}/best")->assertStatus(200);
        $this->assertTrue($replies[0]->isBest());
        $this->assertFalse($replies[1]->isBest());
    }

    /** @test */
    public function only_the_thread_creator_may_mark_the_reply_as_best() {
        $creator = create('App\User');
        $normal = create('App\User');
        $thread = create('App\Thread', ['user_id' => $creator->id]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);
        $this->signIn($creator)->postJson("/replies/{$reply->id}/best")
            ->assertStatus(200);
        $this->signIn($normal)->postJson("/replies/{$reply->id}/best")
            ->assertStatus(403);
    }

}
