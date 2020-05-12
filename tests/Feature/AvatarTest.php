<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AvatarTest extends TestCase {

    /** @test */
    public function only_members_can_add_avatars() {
        $this->post('/api/users/1/avatar')->assertRedirect('/login');
    }

    /** @test */
    public function users_may_add_avatars_to_their_profile() {
        $this->signIn();
        Storage::fake('public');
        Storage::fake('storage');
        $this->withoutExceptionHandling();
        $this->post('/api/users/1/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);
        $this->assertEquals(auth()->user()->avatar, '/storage/avatars/'. $file->hashName());
        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}
