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
        $this->get('profiles/' . $user->name)
            ->assertSee($user->name);
    }
}
