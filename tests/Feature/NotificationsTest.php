<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{

    /** @test */
    public function a_user_is_notified_when_a_subscribed_thread_receives_a_new_reply_excluding_his() {
        $this->signIn();
        $user = auth()->user();
        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');
        $thread->addReply(['user_id' => $user->id, 'body' => 'testing']);
        $this->assertCount(0, $user->notifications);
        $thread->addReply(['user_id' => create('App\User')->id, 'body' => 'testing']);
        $this->assertCount(1, $user->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_his_unread_notifications() {
        $this->signIn();
        $user = auth()->user();
        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');
        $thread->addReply(['user_id' => create('App\User')->id, 'body' => 'testing']);
        $response = $this->get('profiles/' . $user->name . '/notifications')->json();
        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read() {
        $this->signIn();
        $user = auth()->user();
        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');
        $thread->addReply(['user_id' => create('App\User')->id, 'body' => 'testing']);
        $this->assertCount(1, $user->fresh()->unreadNotifications);
        $notificationId = $user->notifications()->first()->id;
        $this->delete('profiles/' . $user->name . '/notifications/' . $notificationId);
        $this->assertCount(0, $user->unreadNotifications);
    }

}
