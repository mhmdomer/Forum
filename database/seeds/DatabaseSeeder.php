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
        $this->call(UsersTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(ThreadsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
    }
}
