<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\IdentificationType;
use Faker\Generator as Faker;

$factory->define(IdentificationType::class, function (Faker $faker) {
    return [
        'id'=>null,
        'name'=>$faker->jobTitle,
        'description'=>$faker->sentence
    ];
});
