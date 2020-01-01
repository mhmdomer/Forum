<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $channels = factory('App\Channel', 4)->create();
        $channels->each(function($channel) {
            factory('App\Thread', 3)->create(['channel_id' => $channel->id]);
        });
        $threads = App\Thread::all();
        $threads->each(function($thread) {
            factory('App\Reply', 6)->create(['thread_id' => $thread->id]);
        });
    }
}
