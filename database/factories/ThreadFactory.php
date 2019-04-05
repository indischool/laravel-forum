<?php

use Faker\Generator as Faker;

$factory->define(App\Thread::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'channel_id' => factory('App\Channel'),
        'title' => $faker->sentence(),
        'body' => $faker->paragraph()
    ];
});
