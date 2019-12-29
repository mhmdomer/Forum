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
        $threads = factory('App\Thread', 10)->create();
        $threads->each(function($thread) {
            factory('App\Reply', 6)->create(['thread_id' => $thread->id]);
        });
    }
}
