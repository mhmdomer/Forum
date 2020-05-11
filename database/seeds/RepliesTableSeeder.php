<?php

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $threads = collect(Thread::all()->modelKeys());
        $users = collect(User::all()->modelKeys());
        $data = [];
        for($i = 0; $i < 200; $i++) {
            $data[] = [
                'user_id' => $users->random(),
                'thread_id' => $threads->random(),
                'body' => $faker->paragraph,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        $chunks = array_chunk($data, 100);
        foreach($chunks as $chunk) {
            Reply::insert($chunk);
        }

    }

}
