<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    /** @test */
    public function user_has_a_profile() {
        $user = create('App\User');
        $this->get('/profiles/' . $user->name)
            ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_threads_by_associated_user() {
        $this->signIn();
        $thread = create('App\Thread', ['user_id' => auth()->id()]);
        $this->get('/profiles/' . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
