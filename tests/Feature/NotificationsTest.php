<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{

    public function setUp() :void{
        parent::setUp();
        $this->signIn();
        $this->user = auth()->user();
    }

    /** @test */
    public function a_user_is_notified_when_a_subscribed_thread_receives_a_new_reply_excluding_his() {
        $thread = create('App\Thread');
        $this->post($thread->path() . '/subscriptions');
        $thread->addReply(['user_id' => $this->user->id, 'body' => 'testing']);
        $this->assertCount(0, $this->user->notifications);
        $thread->addReply(['user_id' => create('App\User')->id, 'body' => 'testing']);
        $this->assertCount(1, $this->user->fresh()->notifications);
    }

    /** @test */
    public function a_user_can_fetch_his_unread_notifications() {
        create(DatabaseNotification::class);
        $response = $this->get('profiles/' . $this->user->name . '/notifications')->json();
        $this->assertCount(1, $response);
    }

    /** @test */
    public function a_user_can_mark_a_notification_as_read() {
        create(DatabaseNotification::class);
        $this->assertCount(1, $this->user->fresh()->unreadNotifications);
        $notificationId = $this->user->notifications()->first()->id;
        $this->delete('profiles/' . $this->user->name . '/notifications/' . $notificationId);
        $this->assertCount(0, $this->user->unreadNotifications);
    }

}
