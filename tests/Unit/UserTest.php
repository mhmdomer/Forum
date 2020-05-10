<?php

namespace Tests\Unit;

use App\Activity;
use Carbon\Carbon;
use Tests\TestCase;

class UserTest extends TestCase
{

    /** @test */
    public function a_user_can_fetch_his_latest_reply() {
        $user = create('App\User');
        create('App\Reply', ['user_id' => $user->id]);
        $reply = $user->latestReply();
        $this->assertEquals($user->id, $reply->user_id);
    }

}
