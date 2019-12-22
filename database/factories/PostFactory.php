<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function()
        {
            return User::inRandomOrder()->first()->id;
        },
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'thumbnail' => $faker->imageUrl(),
        'status' => $faker->boolean()
    ];
});
