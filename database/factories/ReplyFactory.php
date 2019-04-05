<?php
use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'thread_id' => factory('App\Thread'),
        'user_id' => factory('App\User'),
        'body' => $faker->paragraph
    ];
});
