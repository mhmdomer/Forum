<?php

namespace Tests\Feature;

use Tests\TestCase;

class MentionUsersTest extends TestCase
{

    /** @test */
    public function mentioned_users_in_a_reply_receive_notification() {
        $ahmed = create('App\User', ['name' => 'ahmed']);
        $this->signIn($ahmed);
        $mohammed = create('App\User', ['name' => 'mohammed']);
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => '@mohammed checkout this thread!!']);
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->assertCount(1, $mohammed->notifications);
    }

    /** @test */
    public function mentioned_user_may_not_receive_more_than_one_notification_per_reply() {
        $ahmed = create('App\User', ['name' => 'ahmed']);
        $this->signIn($ahmed);
        $mohammed = create('App\User', ['name' => 'mohammed']);
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => '@mohammed checkout this @mohammed thread!!']);
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->assertCount(1, $mohammed->notifications);
    }

}
