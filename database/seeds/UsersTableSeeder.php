<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        App\User::firstOrCreate([
            'name' => 'mohammed',
            'email' => 'mohammedomer789@gmail.com',
            'password' => Hash::make('111111')
        ]);

        App\User::firstOrCreate([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make('111111')
        ]);
        for($i = 0; $i < 20; $i++) {
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('111111'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        $chunks = array_chunk($data, 10);
        foreach($chunks as $chunk) {
            User::insert($chunk);
        }
    }
}
