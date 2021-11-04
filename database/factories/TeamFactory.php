<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Team;
use Faker\Generator as Faker;

$factory->define(\App\Model\Team::class, function (Faker $faker) {
    return [
        'salary' => 25000000
    ];
});
