<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'country_id' => random_int(1, 5),
        'address' => $faker->address,
        'phone' => $faker->unique()->phoneNumber,
        'avatar' => $faker->imageUrl(),
    ];
});
