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

    /** @test */
    public function if_the_user_mentioned_himself_he_would_not_get_a_notification() {
        $ahmed = create('App\User', ['name' => 'ahmed']);
        $this->signIn($ahmed);
        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => '@ahmed checkout this thread!! @mohammed']);
        $this->post($thread->path() . '/replies', $reply->toArray());
        $this->assertCount(0, $ahmed->notifications);
    }

    /** @test */
    public function it_can_fetch_all_users_starting_with_given_characters() {
        $user = create('App\User', ['name' => 'mohammed']);
        create('App\User', ['name' => 'maya']);
        create('App\User', ['name' => 'khalid']);
        $this->signIn($user);
        $result = $this->getJson('/query/profiles/m');
        $this->assertCount(2, $result->json());
    }

}
