<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory("App\User")->create()->id;
        },
        'channel_id' => function() {
            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});


$factory->define(App\Channel::class, function (Faker $faker) {
    $word = $faker->word;
    return [
        'name' => $word,
        'slug' => $word,
    ];
});

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory("App\User")->create()->id;
        },
        'thread_id' => function() {
            return factory("App\Thread")->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});
