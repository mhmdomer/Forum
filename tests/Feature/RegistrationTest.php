<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class RegistrationTest extends TestCase {

    /** @test */
    public function a_confirmation_email_is_sent_upon_registration() {
        Notification::fake();
        event(new Registered(auth()->user()));  
        $data = [
            'name' => 'mohammed',
            'email' => 'mohammed@gmail.com',
            'password' => '11111111',
            'password_confirmation' => '11111111'
        ];
        $this->post('/register', $data);
        Notification::assertSentTo(auth()->user(), VerifyEmail::class);
    }

}
