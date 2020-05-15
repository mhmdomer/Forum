<?php

namespace Tests\Unit;

use App\Activity;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UsersTest extends TestCase
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
        $this->assertEquals('/images/avatars/default.jpg', $user->avatar);
        $user->avatar = 'avatars/me.jpg';
        $this->assertEquals($user->avatar, '/storage/avatars/me.jpg');
    }

    /** @test */
    public function a_user_can_be_marked_as_an_admin() {
        $user = create('App\User');
        $this->assertFalse($user->admin);
        $user->makeAdmin();
        $this->assertTrue($user->fresh()->admin);
    }

    /** @test */
    public function an_admin_can_be_marked_as_a_regular_user() {
        $user = create('App\User');
        $user->makeAdmin();
        $this->assertTrue($user->admin);
        $user->removeAdmin();
        $this->assertFalse($user->admin);
    }

}
