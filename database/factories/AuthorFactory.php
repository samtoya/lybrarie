<?php

/** @var Factory $factory */

use App\Models\Author;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(App\Models\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
