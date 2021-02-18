<?php

namespace Database\Seeders;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = collect(User::all()->modelKeys());
        $channels = collect(Channel::all()->modelKeys());
        for($i = 0; $i < 20; $i++) {
            $title = $faker->sentence;
            $data[] = [
                'user_id' => $users->random(),
                'channel_id' => $channels->random(),
                'title' => $title,
                'body' => $faker->paragraph,
                'visits' => 0,
                'slug' => str_slug($title),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        $chunks = array_chunk($data, 10);
        foreach($chunks as $chunk) {
            Thread::insert($chunk);
        }
        factory(Thread::class, 3)->create(['channel_id' => 1, 'user_id' => 1]);
    }
}
