<?php

namespace Tests\Unit;

use App\Activity;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
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

    /** @test */
    public function a_user_can_add_an_avatar_to_his_profile() {
        $user = create('App\User');
        $this->assertEquals(asset('images/avatars/default.jpg'), $user->avatar());
        $user->avatar = 'avatars/me.jpg';
        $this->assertEquals(asset($user->avatar), $user->avatar());
    }

}
