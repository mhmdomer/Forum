<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::firstOrCreate([
            'name' => 'mohammed',
            'email' => 'mohammedomer789@gmail.com',
            'password' => Hash::make('111111')
        ]);
        $channels = factory('App\Channel', 4)->create();
        $channels->each(function($channel) {
            factory('App\Thread', 3)->create(['channel_id' => $channel->id]);
        });
        factory('App\Thread', 4)->create(['user_id' => $user->id]);
        $threads = App\Thread::all();
        $threads->each(function($thread) {
            factory('App\Reply', 6)->create(['thread_id' => $thread->id]);
        });
    }
}
