<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define( App\Models\Book::class, function ( Faker $faker ) {
    return [
        'title' => $faker->sentence(),
        'isbn'  => rand( 1, 10 ),
        'year'  => $faker->year
    ];
} );
